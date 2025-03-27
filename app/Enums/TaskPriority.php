<?php

namespace App\Enums;

enum TaskPriority: string
{
    case HIGH = 'high';
    case MEDIUM = 'medium';
    case LOW = 'low';

    public function label(): string
    {
        return match($this) {
            self::HIGH => 'Yüksek',
            self::MEDIUM => 'Orta',
            self::LOW => 'Düşük',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::HIGH => 'red',
            self::MEDIUM => 'orange',
            self::LOW => 'green',
        };
    }

    public function icon(): string
    {
        return match($this) {
            self::HIGH => '<path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>',
            self::MEDIUM => '<path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>',
            self::LOW => '<path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>',
        };
    }

    public function badgeClasses(): string
    {
        return match($this) {
            self::HIGH => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
            self::MEDIUM => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-300',
            self::LOW => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
        };
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function toSelectArray(): array
    {
        return array_combine(self::toArray(), array_map(fn($case) => self::from($case)->label(), self::toArray()));
    }
}
