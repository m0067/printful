<?php

declare(strict_types=1);

namespace Dev\Printful\Cache;

class FileCache extends AbstractCache
{
    protected function doSet(string $key, string $marshalledData, int $duration): self
    {
        $filePath = $this->getFilePath($key);
        $expiresAt = \time() + $duration;
        $data = $expiresAt.'\n'.\rawurlencode($key).'\n'.$marshalledData;
        $this->write($filePath, $data);

        return $this;
    }

    protected function doGet(string $key): null|string
    {
        $now = \time();
        $filePath = $this->getFilePath($key);
        $handle = @\fopen($filePath, 'r');

        if (!\is_file($filePath) || !$handle) {
            return null;
        }

        $expiresAt = (int)\fgets($handle);

        if ($expiresAt && $now >= $expiresAt) {
            \fclose($handle);
            @\unlink($filePath);

            return null;
        }

        $storedKey = \rawurldecode(\rtrim(\fgets($handle)));
        $value = \stream_get_contents($handle);
        \fclose($handle);

        if ($key !== $storedKey) {
            return null;
        }

        return $value;
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
        if (!\is_dir($this->getDir()) && !\mkdir($this->getDir(), 0777) && !\is_dir($this->getDir())) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $this->getDir()));
        }

        $tmpFile = $filePath.\bin2hex(\random_bytes(7));
        $handle = \fopen($tmpFile, 'x');
        \fwrite($handle, $data);
        \fclose($handle);

        \rename($tmpFile, $filePath);
    }
}
