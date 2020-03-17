<?php declare(strict_types=1);

namespace Domain;

trait Enumerated
{
    /**
     * @var array<string, self>
     */
    private static array $values = [];

    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return self[]
     */
    public static function values(): array
    {
        if (!self::$values) {
            self::init();
        }

        return array_values(self::$values);
    }

    public function equals(self $enum): bool
    {
        return $this->value === $enum->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function fromString(string $value): self
    {
        if (!self::$values) {
            self::init();
        }

        if (!isset(self::$values[$value])) {
            throw new \RuntimeException(sprintf('invalid value "%s"', $value));
        }

        return self::$values[$value];
    }

    private static function get(string $value): self
    {
        if (!self::$values) {
            self::init();
        }

        return self::$values[$value];
    }

    private static function init(): void
    {
        foreach ((new \ReflectionClass(static::class))->getReflectionConstants() as $name => $constantReflection) {
            $constantValue = $constantReflection->getValue();

            if (in_array($constantValue, self::$values, true)) {
                throw new \RuntimeException(sprintf('duplicated value "%s"', $constantValue));
            }

            self::$values[$constantValue] = new static($constantValue);
        }
    }
}
