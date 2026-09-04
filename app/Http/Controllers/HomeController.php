<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private function getArticles()
    {
        return [
            [
                'id' => 1,
                'slug' => 'textile-storytelling-in-modern-fashion',
                'title' => 'Textile Storytelling in Modern Fashion',
                'category' => 'Lifestyle',
                'secondary_tag' => 'Fashion',
                'date' => 'Jun 13, 2025',
                'read_time' => '6 mins read',
                'excerpt' => 'In today\'s fashion landscape, textiles are more than just fabric — they\'re vessels of culture, memory, and futuristic innovation.',
                'content' => 'In today\'s fashion landscape, textiles are more than just fabric — they\'re vessels of culture, memory, and futuristic innovation. Modern designers are blending ancestral weaving techniques with computational design and bio-fabricated threads. The resulting garments tell layered narratives that challenge standard silhouettes and champion sustainable craftsmanship.',
                'image' => 'https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=800&q=80',
                'author' => [
                    'name' => 'Evora Rose',
                    'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                    'role' => 'Fashion Editor'
                ],
                'comments' => 98,
                'views' => 162,
                'is_featured' => true,
                'card_type' => 'hero'
            ],
            [
                'id' => 2,
                'slug' => 'museums-x-couture-a-new-collaboration',
                'title' => 'Museums x Couture: A New Collaboration',
                'category' => 'Culture',
                'secondary_tag' => 'Art',
                'date' => 'Jun 13, 2025',
                'read_time' => '6 mins read',
                'excerpt' => 'Where history meets high fashion, a new wave of collaboration is redefining both art and style through immersive exhibits.',
                'content' => 'Where history meets high fashion, a new wave of collaboration is redefining both art and style. Leading galleries in Paris, London, and Tokyo are inviting haute couture houses to curate interactive wings where digital projections and centuries-old artifacts converse with avant-garde sculptures.',
                'image' => 'https://images.unsplash.com/photo-1576995853123-5a10305d93c0?auto=format&fit=crop&w=800&q=80',
                'author' => [
                    'name' => 'Julian Sterling',
                    'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80',
                    'role' => 'Culture Critic'
                ],
                'comments' => 98,
                'views' => 162,
                'is_featured' => true,
                'card_type' => 'hero'
            ],
            [
                'id' => 3,
                'slug' => 'futuristic-tailoring-and-sustainable-couture',
                'title' => 'Textile Storytelling in Modern Fashion',
                'category' => 'Lifestyle',
                'secondary_tag' => 'Design',
                'date' => 'Jun 13, 2025',
                'read_time' => '6 mins read',
                'excerpt' => 'In today\'s fashion landscape, textiles are more than just fabric — they\'re vessels of culture, conscious living, and tactile identity.',
                'content' => 'The fusion of sustainable organic fibres and algorithmic pattern generation has unlocked unprecedented textures. Today\'s designers reframe clothing as living armor for an increasingly digital world.',
                'image' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=800&q=80',
                'author' => [
                    'name' => 'Elena Cruz',
                    'avatar' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=200&q=80',
                    'role' => 'Style Curator'
                ],
                'comments' => 98,
                'views' => 162,
                'is_featured' => true,
                'card_type' => 'hero'
            ],
            [
                'id' => 4,
                'slug' => 'canvas-and-couture-art-inspired-runways-2025',
                'title' => 'Canvas & Couture: Art-Inspired Runways 2025',
                'category' => 'Fashion',
                'secondary_tag' => 'Runway',
                'date' => 'Jun 13, 2025',
                'read_time' => '6 mins read',
                'excerpt' => 'When brushstrokes inspire hemlines and canvases shape silhouettes, runway shows transform into living, breathing gallery exhibitions.',
                'content' => 'This season\'s Milan and New York runway presentations broke the mold with collections rendered directly in dialogue with contemporary painters. High gloss vinyl, painted silks, and kinetic accessories dominated the scene.',
                'image' => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=1200&q=80',
                'author' => [
                    'name' => 'Evora Rose',
                    'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80',
                    'role' => 'Lead Writer'
                ],
                'comments' => 142,
                'views' => 380,
                'card_type' => 'latest_main'
            ],
            [
                'id' => 5,
                'slug' => 'palette-and-pattern-arts-role-in-fashion',
                'title' => 'Palette & Pattern: Art\'s Role in Fashion',
                'category' => 'Art',
                'secondary_tag' => 'Trends',
                'date' => 'Jun 12, 2025',
                'read_time' => '5 mins read',
                'excerpt' => 'Exploring how color theory and botanical patterns are shaping the season\'s aesthetic palette.',
                'content' => 'Visual artists and patternmakers are partnering with luxury brands to produce botanical and abstract prints that celebrate human expression and intricate hand-dyeing processes.',
                'image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80',
                'author' => [
                    'name' => 'Maya Lin',
                    'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=200&q=80',
                    'role' => 'Art Specialist'
                ],
                'comments' => 98,
                'views' => 162,
                'card_type' => 'latest_side'
            ],
            [
                'id' => 6,
                'slug' => 'urban-renaissance-streetwear-as-art',
                'title' => 'Urban Renaissance: Streetwear as Art',
                'category' => 'Sports',
                'secondary_tag' => 'Streetwear',
                'date' => 'Jun 11, 2025',
                'read_time' => '6 mins read',
                'excerpt' => 'How underground street culture redefined luxury aesthetics and museum galleries around the globe.',
                'content' => 'Streetwear has officially crossed the threshold from subculture to high art. From oversized tailored blazers to technical utility outerwear, global creators are championing authentic urban stories.',
                'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=600&q=80',
                'author' => [
                    'name' => 'Kofi Mensah',
                    'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80',
                    'role' => 'Culture Editor'
                ],
                'comments' => 98,
                'views' => 162,
                'card_type' => 'latest_side'
            ],
            [
                'id' => 7,
                'slug' => 'gallery-to-garment-art-meets-design',
                'title' => 'Gallery to Garment: Art Meets Design',
                'category' => 'Lifestyle',
                'secondary_tag' => 'Model',
                'date' => 'Jun 13, 2025',
                'read_time' => '6 mins read',
                'excerpt' => 'When brushstrokes inspire hemlines and canvases shape silhouettes, the result is a striking fusion of visual art and fashion design.',
                'content' => 'A behind-the-scenes look at how master tailors translate vibrant acrylic paintings into structural garments with sculptural pleats and iridescent textures.',
                'image' => 'https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=800&q=80',
                'has_video' => true,
                'author' => [
                    'name' => 'Eleanor Pena',
                    'avatar' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=200&q=80',
                    'role' => 'Senior Editor'
                ],
                'comments' => 98,
                'views' => 162,
                'card_type' => 'dual_column'
            ],
            [
                'id' => 8,
                'slug' => 'sustainable-eating-in-a-climate-conscious-world',
                'title' => 'Sustainable Eating in a Climate-Conscious World',
                'category' => 'Health',
                'secondary_tag' => 'Food',
                'date' => 'Jun 13, 2025',
                'read_time' => '6 mins read',
                'excerpt' => 'As climate concerns grow, our plates are becoming powerful tools for change. Sustainable eating—centered on plant-based choices, local sourcing, and reducing food waste.',
                'content' => 'Culinary innovators and ecological researchers are uniting to invent sustainable dining rituals that honor biodiversity, regeneratively grown grains, and delicious seasonal vegetables.',
                'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=800&q=80',
                'has_video' => false,
                'author' => [
                    'name' => 'Bessie Cooper',
                    'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=200&q=80',
                    'role' => 'Gastronomy Lead'
                ],
                'comments' => 98,
                'views' => 162,
                'card_type' => 'dual_column'
            ]
        ];
    }

    public function index(Request $request)
    {
        $allArticles = $this->getArticles();

        $breakingNews = [
            'Sustainable Eating in a Climate-Conscious World',
            'Artificial Intelligence Transforms Runway Production at Paris Fashion Week',
            'Biodegradable Bio-Textiles Set New Global Standards for Eco-Couture',
            'Architectural Minimalism: Inside Tokyo’s Newest Design Pavilion'
        ];

        $categories = [
            ['name' => 'Fashion', 'count' => 68, 'slug' => 'fashion', 'active' => true],
            ['name' => 'Artificial Intelligence', 'count' => 116, 'slug' => 'artificial-intelligence', 'active' => false],
            ['name' => 'Food and Drink', 'count' => 70, 'slug' => 'food-and-drink', 'active' => false],
            ['name' => 'Business', 'count' => 28, 'slug' => 'business', 'active' => false],
            ['name' => 'Design', 'count' => 25, 'slug' => 'design', 'active' => false],
            ['name' => 'Technology', 'count' => 85, 'slug' => 'technology', 'active' => false],
            ['name' => 'Science', 'count' => 120, 'slug' => 'science', 'active' => false],
            ['name' => 'Innovation', 'count' => 63, 'slug' => 'innovation', 'active' => false],
            ['name' => 'Lifestyle', 'count' => 95, 'slug' => 'lifestyle', 'active' => false]
        ];

        $heroArticles = array_slice($allArticles, 0, 3);
        $latestMain = $allArticles[3];
        $latestSide = array_slice($allArticles, 4, 2);
        $dualColumns = array_slice($allArticles, 6, 2);

        $partnerBrands = [
            ['name' => 'CUEBE', 'icon' => 'cube'],
            ['name' => 'Clickl', 'icon' => 'mouse-pointer'],
            ['name' => 'Retool', 'icon' => 'toolbox'],
            ['name' => 'piab', 'icon' => 'bolt'],
            ['name' => 'ma', 'icon' => 'compass']
        ];

        return view('welcome', compact(
            'breakingNews',
            'categories',
            'heroArticles',
            'latestMain',
            'latestSide',
            'dualColumns',
            'partnerBrands',
            'allArticles'
        ));
    }

    public function show($slug)
    {
        $allArticles = $this->getArticles();
        $article = collect($allArticles)->firstWhere('slug', $slug);

        if (!$article) {
            abort(404, 'Article not found');
        }

        $relatedArticles = collect($allArticles)->where('slug', '!=', $slug)->take(3)->values()->all();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        return back()->with('success', 'Thank you for subscribing to MAGZIN. newsletter!');
    }
}
