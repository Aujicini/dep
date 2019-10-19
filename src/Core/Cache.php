<?php declare(strict_types=1);
/**
 * Oxuwazet CMS - A powerful CMS built for speed and security.
 *
 * @link <https://github.com/oxuwazet/oxuwazetcms> Source Code.
 * @link <https://github.com/oxuwazet/oxuwazetcms/issues> Issue Tracker.
 *
 * @author Oxuwazet <https://github.com/oxuwazet> Profile Page.
 *
 * @license Boost Software License 1.0 <https://www.boost.org/LICENSE_1_0.txt> The license main page.
 */

namespace Oxuwazet\CMS\Core;

use Cache\Adapter\Apc\ApcCachePool;
use Cache\Adapter\Apcu\ApcuCachePool;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use Cache\Adapter\Redis\RedisCachePool;
use Cache\Adapter\Memcache\MemcacheCachePool;
use Cache\Adapter\Memcached\MemcachedCachePool;
use Cache\Adapter\Predis\PredisCachePool;
use Cache\Bridge\SimpleCache;
use Cache\Encryption\EncryptedCachePool;
use Defuse\Crypto\Key;
use League\Flysystem\Filesystem;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * The cache handler.
 */
class Cache implements Handler
{
    /** @var array $options The cache options. */
    private $options;

    /**
     * Construct a cache handler.
     *
     * @param array $options The cache handler options.
     *
     * @return void Returns nothing.
     */
    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    /**
     * Get the cache instance.
     *
     * @return CacheInterface Returns the simple cache instance.
     */
    public function getInstance(): CacheInterface
    {
        switch ($this->options['adapter']) {
            case 'apc':
                $pool = new ApcCachePool();
            break;
            case 'apcu':
                $pool = new ApcuCachePool();
            break;
            case 'filesystem':
                $pool = new FilesystemCachePool($this->options['filesystem']);
            break;
            case 'memcache':
                $pool = new MemcacheCachePool($this->options['client']);
            break;
            case 'memcached':
                $pool = new MemcachedCachePool($this->options['client']);
            break;
            case 'predis':
                $pool = new PredisCachePool($this->options['client']);
            break;
            case 'redis':
                $pool = new RedisCachePool($this->options['client']);
            break;
        }
        if ($this->options['encryption'] && isset($this->options['encryption_key'])) {
            $pool = new EncryptedCachePool($pool, $this->options['encryption_key']);
        }
        return new SimpleCache($pool);
    }

    /**
     * Set the cache options.
     *
     * @param array $options The cache options.
     *
     * @return void Returns nothing.
     */
    public function setOptions(): array
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $this->options = $resolver->resolve($options);
    }

    /**
     * Configure the cache handler options.
     *
     * @param OptionsResolver The symfony options resolver.
     *
     * @return void Returns nothing.
     */
    private function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'encryption' => false,
        ]);
        $resolver->isRequired('adapter');
        $resolver->setAllowedTypes('adapter', 'string');
        $resolver->setAllowedValues('adapter', [
            'acp',
            'acpu',
            'filesystem',
            'memcache',
            'memcached',
            'predis',
            'redis',
        ]);
        $resolver->setAllowedTypes('client', 'object');
        $resolver->setAllowedTypes('filesystem', Filesystem);
        $resolver->setAllowedTypes('encryption', 'bool');
        $resolver->setAllowedTypes('encryption_key', Key);
    }
}
