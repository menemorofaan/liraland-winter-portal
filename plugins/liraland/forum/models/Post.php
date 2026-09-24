<?php namespace Liraland\Forum\Models;

use Model;

class Post extends Model
{
    public $table = 'liraland_forum_posts';
    protected $guarded = [];

    public $belongsTo = [
        'topic' => ['Liraland\Forum\Models\Topic'],
        'user'  => ['Winter\User\Models\User']
    ];

    public $attachMany = [
        'attachments' => ['System\Models\File', 'public' => true]
    ];

    // Мутатор форматирования: срабатывает автоматически при обращении к post.formatted_content
    public function getFormattedContentAttribute()
    {
        // 1. Защита от XSS
        $text = htmlspecialchars($this->content, ENT_QUOTES, 'UTF-8');

        // 2. BB-коды: жирный, курсив, подчеркнутый, зачеркнутый
        $text = preg_replace('/\[b\](.*?)\[\/b\]/is', '<strong class="font-bold text-gray-900">$1</strong>', $text);
        $text = preg_replace('/\[i\](.*?)\[\/i\]/is', '<em class="italic">$1</em>', $text);
        $text = preg_replace('/\[u\](.*?)\[\/u\]/is', '<u class="underline decoration-[#0080c6] decoration-2">$1</u>', $text);
        $text = preg_replace('/\[s\](.*?)\[\/s\]/is', '<del class="line-through text-gray-500">$1</del>', $text);

        // Markdown: **bold** и *italic*
        $text = preg_replace('/\*\*(.*?)\*\*/s', '<strong class="font-bold text-gray-900">$1</strong>', $text);
        $text = preg_replace('/(?<!\*)\*(?!\*)(.*?)(?<!\*)\*(?!\*)/s', '<em class="italic">$1</em>', $text);

        // 3. Блоки кода (для логов и формул САПР)
        $text = preg_replace('/\[code\](.*?)\[\/code\]/is', '<pre class="bg-gray-900 text-emerald-400 p-3.5 rounded font-mono text-xs overflow-x-auto my-3 border border-gray-700 shadow-inner"><code>$1</code></pre>', $text);

        // 4. Цитаты
        $text = preg_replace('/\[quote=([^\]]+)\](.*?)\[\/quote\]/is', '<blockquote class="border-l-4 border-[#0080c6] bg-blue-50/60 p-3 my-3 text-xs text-gray-700 rounded-r shadow-2xs"><div class="font-bold text-[#0080c6] mb-1">Цитата ($1):</div>$2</blockquote>', $text);
        $text = preg_replace('/\[quote\](.*?)\[\/quote\]/is', '<blockquote class="border-l-4 border-gray-400 bg-gray-50 p-3 my-3 text-xs italic text-gray-600 rounded-r shadow-2xs">$1</blockquote>', $text);

        // 5. Спойлеры
        $text = preg_replace('/\[spoiler=([^\]]+)\](.*?)\[\/spoiler\]/is', '<details class="my-3 bg-gray-50 border border-gray-200 rounded p-2.5 text-xs"><summary class="cursor-pointer font-semibold text-[#0080c6] hover:underline select-none">▶ $1</summary><div class="mt-2 pt-2 border-t border-gray-200 text-gray-700">$2</div></details>', $text);
        $text = preg_replace('/\[spoiler\](.*?)\[\/spoiler\]/is', '<details class="my-3 bg-gray-50 border border-gray-200 rounded p-2.5 text-xs"><summary class="cursor-pointer font-semibold text-[#0080c6] hover:underline select-none">▶ Прихований вміст (спойлер)</summary><div class="mt-2 pt-2 border-t border-gray-200 text-gray-700">$1</div></details>', $text);

        // 6. Изображения и GIF через тег [img]
        $text = preg_replace('/\[img\](https?:\/\/[^\"\s<>]+)\[\/img\]/i', '<div class="my-3"><img src="$1" alt="GIF або зображення" class="max-w-xl max-h-96 rounded border border-gray-300 shadow-sm" loading="lazy"></div>', $text);

        // 7. Ссылки
        $text = preg_replace('/\[url=(https?:\/\/[^\"\s<>]+)\](.*?)\[\/url\]/i', '<a href="$1" target="_blank" rel="noopener noreferrer" class="text-[#0080c6] font-semibold hover:underline">$2 ↗</a>', $text);
        $text = preg_replace('/\[url\](https?:\/\/[^\"\s<>]+)\[\/url\]/i', '<a href="$1" target="_blank" rel="noopener noreferrer" class="text-[#0080c6] font-semibold hover:underline">$1 ↗</a>', $text);

        // 8. Авторазвертывание прямых ссылок на GIF/изображения
        $text = preg_replace('/(^|\s)(https?:\/\/[^\s]+\.(gif|png|jpg|jpeg|webp))(\s|$)/i', '$1<div class="my-3"><img src="$2" alt="GIF" class="max-w-xl max-h-96 rounded border border-gray-300 shadow-sm" loading="lazy"></div>$4', $text);

        return nl2br($text);
    }
}
