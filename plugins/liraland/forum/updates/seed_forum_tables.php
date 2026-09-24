<?php namespace Liraland\Forum\Updates;

use Winter\Storm\Database\Updates\Seeder;
use Liraland\Forum\Models\Category;
use Liraland\Forum\Models\Channel;
use Liraland\Forum\Models\Topic;
use Liraland\Forum\Models\Post;

class SeedForumTables extends Seeder
{
    public function run()
    {
        // 1. Корневой канал без категории
        Channel::create([
            'category_id'      => null,
            'title'            => 'Еще не купили?',
            'slug'             => 'eshche-ne-kupili',
            'description'      => 'Стоите перед выбором? Задайте свой вопрос. Покупка и обмен, акции и скидки, сертификация.',
            'count_topics'     => 48,
            'count_posts'      => 220,
            'last_post_title'  => 'Конфигурации',
            'last_post_user'   => 'alektish',
            'last_post_at'     => '29.03.2023 18:36:31',
            'sort_order'       => 1
        ]);

        // 2. Категория «ЛИРА-САПР»
        $lira = Category::create(['title' => '«ЛИРА-САПР»', 'slug' => 'lira-sapr', 'sort_order' => 10]);
        $chLira = Channel::create([
            'category_id'      => $lira->id,
            'title'            => 'Работа программы (lira)',
            'slug'             => 'rabota-programmy-lira',
            'description'      => 'Вопросы по программному комплексу ЛИРА-САПР. Как, где, каким образом, почему и т.д.',
            'count_topics'     => 1012,
            'count_posts'      => 7083,
            'last_post_title'  => 'Пластинні аналоги. Допоможіть розрахунком.',
            'last_post_user'   => 'Yarov Rostislav',
            'last_post_at'     => '20.07.2026 11:15:44',
            'sort_order'       => 11
        ]);
        Channel::create([
            'category_id'      => $lira->id,
            'title'            => 'Проблемы моделирования',
            'slug'             => 'problemy-modelirovaniya',
            'description'      => 'Как смоделировать? Как задать расчетную схему? Какие элементы выбрать?',
            'count_topics'     => 708,
            'count_posts'      => 4832,
            'last_post_title'  => 'Пасивний опір грунту',
            'last_post_user'   => 'alektish',
            'last_post_at'     => '14.05.2026 11:05:46',
            'sort_order'       => 12
        ]);

        // Создаем реальную тему для демонстрации кликабельности
        $demoTopic = Topic::create([
            'channel_id'   => $chLira->id,
            'author_name'  => 'Yarov Rostislav',
            'title'        => 'Пластинні аналоги. Допоможіть розрахунком.',
            'slug'         => 'plastinni-analohy-dopomozhit-rozrakhunkom',
            'count_views'  => 142,
            'count_posts'  => 3
        ]);

        Post::create([
            'topic_id'    => $demoTopic->id,
            'author_name' => 'Yarov Rostislav',
            'content'     => "Вітаю колеги! Розраховую безбалкове перекриття монолітного каркасу в ЛІРА-САПР 2024. Виникло питання щодо правильного завдання жорсткостей пластинних аналогів у зоні спирання колон (для адекватного врахування продавлювання). Додаю файл розрахункової схеми .lir для наочності."
        ]);

        // 3. Категория «МОНОМАХ-САПР»
        $monomakh = Category::create(['title' => '«МОНОМАХ-САПР»', 'slug' => 'monomakh-sapr', 'sort_order' => 20]);
        Channel::create([
            'category_id'      => $monomakh->id,
            'title'            => 'Работа программы (ПК МОНОМАХ-САПР)',
            'slug'             => 'rabota-programmy-pk-monomakh-sapr',
            'description'      => 'Вопросы по программному комплексу. Как, где, каким образом, почему и т.д.',
            'count_topics'     => 302,
            'count_posts'      => 1580,
            'last_post_title'  => 'опирание плит',
            'last_post_user'   => 'alektish',
            'last_post_at'     => '19.06.2026 09:01:03',
            'sort_order'       => 21
        ]);

        // 4. Категория «Эспри»
        $espri = Category::create(['title' => '«Эспри»', 'slug' => 'espri', 'sort_order' => 30]);
        Channel::create([
            'category_id'      => $espri->id,
            'title'            => 'Работа программы (Эспри)',
            'slug'             => 'rabota-programmy-espri',
            'description'      => 'Вопросы по программе Эспри. Как, где, каким образом, почему и т.д.',
            'count_topics'     => 19,
            'count_posts'      => 72,
            'last_post_title'  => 'Переход от удельного веса грунта к удельному весу, взвешенного в воде',
            'last_post_user'   => 'alektish',
            'last_post_at'     => '16.03.2023 22:48:03',
            'sort_order'       => 31
        ]);

        // 5. Категория «Сапфир»
        $sapfir = Category::create(['title' => '«Сапфир»', 'slug' => 'sapfir', 'sort_order' => 40]);
        Channel::create([
            'category_id'      => $sapfir->id,
            'title'            => 'Работа программы (Сапфир)',
            'slug'             => 'rabota-programmy-sapfir',
            'description'      => 'Вопросы по программному комплексу Сапфир. Как, где, каким образом, почему и т.д.',
            'count_topics'     => 259,
            'count_posts'      => 1472,
            'last_post_title'  => 'Программирование в Сапфир',
            'last_post_user'   => 'Expert_Hell',
            'last_post_at'     => '13.08.2026 04:24:47',
            'sort_order'       => 41
        ]);

        // 6. Категория «Разное»
        $raznoe = Category::create(['title' => 'Разное', 'slug' => 'raznoe', 'sort_order' => 50]);
        Channel::create([
            'category_id'      => $raznoe->id,
            'title'            => 'Железо, операционные системы, драйвера',
            'slug'             => 'zhelezo-operatsionnye-sistemy-drayvera',
            'description'      => 'Если в вопросе присутствуют слова связанные с аппаратным обеспечением, драйверами, ноутбуками, операционными системами, видеокартами и т.д., то он должен попасть в этот раздел',
            'count_topics'     => 43,
            'count_posts'      => 191,
            'last_post_title'  => 'Не удается подключить локальный ключ',
            'last_post_user'   => 'alektish',
            'last_post_at'     => '17.05.2024 11:18:58',
            'sort_order'       => 51
        ]);
        Channel::create([
            'category_id'      => $raznoe->id,
            'title'            => 'Работа сайта',
            'slug'             => 'rabota-sayta',
            'description'      => 'В данном форуме обсуждаются любые вопросы, связанные с работой нашего сайта',
            'count_topics'     => 29,
            'count_posts'      => 130,
            'last_post_title'  => '"Идеи" отображают первое сообщение в поле текста ввода',
            'last_post_user'   => 'ander',
            'last_post_at'     => '20.12.2021 06:36:35',
            'sort_order'       => 52
        ]);
        Channel::create([
            'category_id'      => $raznoe->id,
            'title'            => '404 - другие темы',
            'slug'             => '404-drugie-temy',
            'description'      => 'Если вопрос не подходит в разделы выше, то задавайте его сюда.',
            'count_topics'     => 29,
            'count_posts'      => 141,
            'last_post_title'  => 'лицензия на программу.',
            'last_post_user'   => 'haveyona23',
            'last_post_at'     => '14.04.2026 09:55:02',
            'sort_order'       => 53
        ]);
    }
}
