<?php

namespace App\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Bekliyor',
            self::IN_PROGRESS => 'Devam Ediyor',
            self::COMPLETED => 'Tamamlandı',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::PENDING => 'yellow',
            self::IN_PROGRESS => 'blue',
            self::COMPLETED => 'green',
        };
    }

    public function icon(): string
    {
        return match($this) {
            self::COMPLETED => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>',
            self::IN_PROGRESS => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>',
            self::PENDING => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>',
        };
    }

    public function badgeClasses(): string
    {
        return match($this) {
            self::COMPLETED => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
            self::IN_PROGRESS => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
            self::PENDING => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
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
