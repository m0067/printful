<?php

declare(strict_types=1);

namespace Dev\Printful\Cache;

class FileCache extends AbstractCache
{
    /**
     * @inheritDoc
     */
    public function set(string $key, $value, int $duration)
    {
        $filePath = $this->getFilePath($key);
        $value = $this->marshaller->marshal($value);
        $expiresAt = \time() + $duration;
        $data = $expiresAt.'\n'.\rawurlencode($key).'\n'.$value;
        $this->write($filePath, $data);
    }

    /**
     * @inheritDoc
     */
    public function get(string $key)
    {
        $value = $this->validate($key);

        if (\is_bool($value) && !$value) {
            return null;
        }

        return $this->marshaller->unmarshal($value);
    }

    private function getFilePath(string $key): string
    {
        $hash = \str_replace('/', '-', \base64_encode(\sha1($key, true)));

        return $this->getDir().$hash;
    }

    private function getDir(): string
    {
        return \sys_get_temp_dir().'/dev-printful-cache/';
    }

    private function write(string $filePath, string $data): void
    {
        $tmpFile = $filePath.\bin2hex(\random_bytes(7));

        $handle = \fopen($tmpFile, 'x');
        \fwrite($handle, $data);
        \fclose($handle);

        \rename($tmpFile, $filePath);
    }

    private function delete(string $filePath): bool
    {
        return @\unlink($filePath);
    }

    private function validate(string $key): false|string
    {
        $now = \time();
        $filePath = $this->getFilePath($key);
        $handle = @\fopen($filePath, 'r');

        if (!\is_file($filePath) || !$handle) {
            return false;
        }

        $expiresAt = (int)\fgets($handle);

        if ($expiresAt && $now >= $expiresAt) {
            \fclose($handle);
            $this->delete($filePath);

            return false;
        }

        $storedKey = \rawurldecode(\rtrim(\fgets($handle)));
        $value = \stream_get_contents($handle);
        \fclose($handle);

        if ($key !== $storedKey) {
            return false;
        }

        return $value;
    }
}
