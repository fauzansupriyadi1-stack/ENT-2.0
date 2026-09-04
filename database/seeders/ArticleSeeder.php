<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        if (Article::count() > 0) {
            return;
        }

        $articles = [
            [
                'title' => 'Morning Habits for a Productive Mindset',
                'slug' => 'morning-habits-for-a-productive-mindset',
                'category' => 'Lifestyle',
                'secondary_tag' => 'Habits',
                'author_name' => 'Olivia Hart',
                'author_avatar' => 'https://i.pravatar.cc/100?img=5',
                'author_role' => 'Editor in Chief',
                'date' => 'May 10, 2024',
                'read_time' => '5 min read',
                'excerpt' => 'Simple routines that can transform your daily flow and bring more clarity to your workflow.',
                'content' => 'Starting your morning with intention sets the tone for the entire day. Incorporating light movement, brief mindfulness exercises, and drinking water before checking screens can drastically reduce anxiety and improve focus. Small intentional steps compounding daily create incredible long-term momentum.',
                'image' => 'https://images.unsplash.com/photo-1517021897933-0e0319cfbc28?auto=format&fit=crop&q=80&w=1200',
                'likes' => 142
            ],
            [
                'title' => 'The Power of Slow Mornings',
                'slug' => 'the-power-of-slow-mornings',
                'category' => 'Lifestyle',
                'secondary_tag' => 'Wellness',
                'author_name' => 'Olivia Hart',
                'author_avatar' => 'https://i.pravatar.cc/100?img=5',
                'author_role' => 'Editor in Chief',
                'date' => 'May 8, 2024',
                'read_time' => '4 min read',
                'excerpt' => 'Why slowing down and giving yourself quiet breathing room sets a resilient tone for the rest of your busy day.',
                'content' => 'Rushing into the morning creates a fight-or-flight cascade that exhausts your cognitive bandwidth before noon. By giving yourself 30 quiet minutes each morning, you cultivate a sense of calm resilience.',
                'image' => 'https://images.unsplash.com/photo-1544144433-d50aff500b91?auto=format&fit=crop&q=80&w=600',
                'likes' => 89
            ],
            [
                'title' => '10 Hidden Gems You Must Visit',
                'slug' => '10-hidden-gems-you-must-visit',
                'category' => 'Travel',
                'secondary_tag' => 'Guides',
                'author_name' => 'Liam Carter',
                'author_avatar' => 'https://i.pravatar.cc/100?img=11',
                'author_role' => 'Travel Writer',
                'date' => 'May 6, 2024',
                'read_time' => '6 min read',
                'excerpt' => 'Off-the-beaten-path destinations across mountain valleys and coastlines worth adding to your travel bucket list.',
                'content' => 'From hidden coastal coves in Southern Europe to secluded alpine valleys in the Pacific Northwest, discovering lesser-known destinations provides authentic cultural connection and tranquil retreats away from tourist crowds.',
                'image' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&q=80&w=600',
                'likes' => 124
            ],
            [
                'title' => 'How to Stay Focused in a Distracted World',
                'slug' => 'how-to-stay-focused-in-a-distracted-world',
                'category' => 'Productivity',
                'secondary_tag' => 'Deep Work',
                'author_name' => 'Olivia Hart',
                'author_avatar' => 'https://i.pravatar.cc/100?img=5',
                'author_role' => 'Editor in Chief',
                'date' => 'May 4, 2024',
                'read_time' => '5 min read',
                'excerpt' => 'Practical environmental tweaks and cognitive frameworks to improve deep work and get more done with less stress.',
                'content' => 'Deep work requires structuring your environment to eliminate friction and distraction. Batching notifications, defining 90-minute focus blocks, and keeping a physical notebook nearby are proven techniques.',
                'image' => 'https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?auto=format&fit=crop&q=80&w=600',
                'likes' => 78
            ],
            [
                'title' => 'Becoming the Best Version of You',
                'slug' => 'becoming-the-best-version-of-you',
                'category' => 'Personal Growth',
                'secondary_tag' => 'Mindset',
                'author_name' => 'Emma Lawson',
                'author_avatar' => 'https://i.pravatar.cc/100?img=9',
                'author_role' => 'Mindset Coach',
                'date' => 'May 2, 2024',
                'read_time' => '7 min read',
                'excerpt' => 'Small deliberate steps practiced consistently every day lead to compounding positive transformations over time.',
                'content' => 'Personal growth is not a sudden event; it is an ongoing practice of self-awareness and gentle course-correction. Focus on 1% daily improvements rather than radical overnight overhauls.',
                'image' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&q=80&w=600',
                'likes' => 156
            ],
            [
                'title' => 'Designing Minimalist Digital Tools',
                'slug' => 'designing-minimalist-digital-tools',
                'category' => 'Technology',
                'secondary_tag' => 'UX Design',
                'author_name' => 'Marcus Vance',
                'author_avatar' => 'https://i.pravatar.cc/100?img=12',
                'author_role' => 'Product Designer',
                'date' => 'Apr 29, 2024',
                'read_time' => '5 min read',
                'excerpt' => 'How modern software creators are eliminating interface clutter to build intentional, human-centered experiences.',
                'content' => 'Great software design respects the user\'s attention. By reducing non-essential UI elements, embracing generous whitespace, and prioritizing core user workflows, digital tools become intuitive extensions of human thought.',
                'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=600',
                'likes' => 91
            ],
            [
                'title' => 'Creating a Peaceful Living Space',
                'slug' => 'creating-a-peaceful-living-space',
                'category' => 'Lifestyle',
                'secondary_tag' => 'Home',
                'author_name' => 'Olivia Hart',
                'author_avatar' => 'https://i.pravatar.cc/100?img=5',
                'author_role' => 'Editor in Chief',
                'date' => 'Apr 26, 2024',
                'read_time' => '4 min read',
                'excerpt' => 'Decluttering principles and interior accents that transform your home into a calm sanctuary for recharge.',
                'content' => 'Your physical surroundings directly impact your psychological state. Soft natural lighting, warm wooden tones, organic textiles, and decluttered surfaces foster a calming atmosphere.',
                'image' => 'https://images.unsplash.com/photo-1507652313519-d4e9174996dd?auto=format&fit=crop&q=80&w=600',
                'likes' => 112
            ],
            [
                'title' => 'The Rule of Three Priorities',
                'slug' => 'the-rule-of-three-priorities',
                'category' => 'Productivity',
                'secondary_tag' => 'Strategy',
                'author_name' => 'Liam Carter',
                'author_avatar' => 'https://i.pravatar.cc/100?img=11',
                'author_role' => 'Productivity Lead',
                'date' => 'Apr 22, 2024',
                'read_time' => '4 min read',
                'excerpt' => 'A timeless system for picking just three major tasks each day to eliminate overwhelm and guarantee momentum.',
                'content' => 'Attempting to tackle 20 items on a daily to-do list creates decision fatigue and superficial progress. Selecting three high-impact objectives ensures focused energy and daily completion satisfaction.',
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=600',
                'likes' => 67
            ]
        ];

        foreach ($articles as $art) {
            Article::create($art);
        }
    }
}
