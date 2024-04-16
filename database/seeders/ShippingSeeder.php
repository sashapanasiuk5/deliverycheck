<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared("INSERT INTO `shipping` (`id`, `name`, `name_ua`, `slug`, `position`, `status`, `has_city`, `has_address`, `has_warehouse`, `has_npcity`, `has_npwarehouse`, `rozetka_id`, `prom_id`, `allo_id`) VALUES
            (3, 'Новая почта', 'Нова пошта', 'novaposhta', 4, 1, 0, 1, 0, 2, 1, 5, 11302985, 4),
            (4, 'Ночной экспрес', 'Нічний експрес', '', 40, 0, 0, 0, 0, 0, 0, 0, 0, 0),
            (5, 'Автолюкс', 'Автолюкс', '', 50, 0, 0, 0, 0, 0, 0, 0, 0, 0),
            (6, 'Укрпочта', 'Укрпошта', 'ukrposhta', 60, 1, 2, 1, 1, 0, 0, 2024, 13348650, 0),
            (12, 'Деливери', 'Делівері', 'delivery', 6, 0, 2, 0, 2, 0, 0, 0, 0, 0),
            (13, 'Meest', 'Meest', '', 3, 0, 2, 0, 2, 0, 0, 4, 0, 0),
            (15, 'Адресная доставка (Чернигов)', 'Адресна доставка (Чернігів)', '', 1, 0, 0, 1, 0, 0, 0, 0, 0, 0),
            (16, 'Адресная доставка (Славутич)', 'Адресна доставка (Славутич)', '', 2, 0, 0, 1, 0, 0, 0, 0, 0, 0),
            (18, 'Пункт выдачи Розетка', 'Пункт видачі Розетка', 'rozetka', 100, 0, 1, 1, 0, 0, 0, 1, 15334178, 0),
            (19, 'САТ', 'САТ', 'sat', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);");
    }
}
