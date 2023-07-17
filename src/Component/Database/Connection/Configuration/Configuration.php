<?php
namespace Laventure\Component\Database\Connection\Configuration;


/**
 * @inheritdoc
*/
class Configuration implements ConfigurationInterface
{


        /**
         * @var array
        */
        protected array $params = [];





        /**
         * @param array $params
        */
        public function __construct(array $params)
        {
             $this->merge($params);
        }





        /**
         * @param string $key
         *
         * @param $value
         *
         * @return $this
        */
        public function set(string $key, $value): static
        {
            $this->params[$key] = $value;

            return $this;
        }





        /**
         * @inheritDoc
        */
        public function merge(array $params): static
        {
             $this->params = array_merge($this->params, $params);

             return $this;
        }





        /**
         * @inheritDoc
        */
        public function get(string $name, $default = null): mixed
        {
            return $this->params[$name] ?? $default;
        }






        /**
         * @inheritDoc
        */
        public function has(string $name): bool
        {
            return isset($this->params[$name]);
        }





        /**
         * @inheritdoc
        */
        public function isEmpty(): bool
        {
            return empty($this->params);
        }







        /**
         * @inheritDoc
        */
        public function remove(string $name): bool
        {
            unset($this->params[$name]);

            return $this->has($name);
        }






        /**
         * @inheritDoc
        */
        public function getParams(): array
        {
            return $this->params;
        }





        /**
         * @inheritDoc
        */
        public function getDriverName(): string
        {
            if (! $this->has('driver')) {
                 $this->abortIf('driver name is required param.');
            }

            return $this->get('driver');
        }






        /**
         * @inheritDoc
        */
        public function getUsername(): ?string
        {
            return $this->get('username');
        }







        /**
         * @inheritDoc
        */
        public function getPassword(): ?string
        {
            return $this->get('password');
        }






        /**
         * @inheritDoc
        */
        public function getCharset(): string
        {
            return $this->get('charset', 'utf8');
        }






        /**
         * @inheritDoc
        */
        public function getPrefix(): string
        {
            return $this->get('prefix', '');
        }





        /**
         * @inheritdoc
        */
        public function getPrefixedTable(string $table): string
        {
            return join([$this->getPrefix(), $table]);
        }







        /**
         * @inheritDoc
        */
        public function getEngine(): string
        {
            return $this->get('engine', '');
        }







        /**
         * @inheritDoc
        */
        public function getHostname(): string
        {
            return $this->get('host', '');
        }






        /**
         * @inheritDoc
        */
        public function getPort(): string
        {
            return $this->get('port', '');
        }





        /**
         * @inheritDoc
        */
        public function getDatabase(): string
        {
            return $this->get('database', '');
        }





        /**
         * @return string
        */
        public function getCollation(): string
        {
            return $this->get('collation', '');
        }






        /**
         * @inheritDoc
        */
        public function offsetExists(mixed $offset): bool
        {
             return $this->has($offset);
        }






        /**
         * @inheritDoc
        */
        public function offsetGet(mixed $offset): mixed
        {
            return $this->get($offset);
        }





        /**
         * @inheritDoc
        */
        public function offsetSet(mixed $offset, mixed $value): void
        {
             $this->set($offset, $value);
        }






        /**
         * @inheritDoc
        */
        public function offsetUnset(mixed $offset): void
        {
            $this->remove($offset);
        }





        /**
         * @param string $message
         *
         * @return mixed
        */
        public function abortIf(string $message): mixed
        {
             return (function () use ($message) {
                 throw new ConfigurationException($message);
             })();
        }
}