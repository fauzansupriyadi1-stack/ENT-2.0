@extends('layouts.app')

@section('content')
<div class="container">
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <span class="tag-new">NEW POST</span>
            <h1 class="hero-title">Thoughts That Inspire, Stories That Connect.</h1>
            <p class="hero-desc">Discover ideas, perspectives, and stories that inspire you to see the world differently.</p>
            <div class="hero-actions">
                <a href="#" class="btn-primary">Explore Articles <i class="fas fa-arrow-right ml-2" style="margin-left: 8px; font-size: 12px;"></i></a>
                <a href="#" class="btn-outline">About Me</a>
            </div>
        </div>
        <div class="hero-image-wrap">
            <img src="https://images.unsplash.com/photo-1517021897933-0e0319cfbc28?auto=format&fit=crop&q=80&w=1200" alt="Hero Image">
            
            <div class="hero-floating-card">
                <span class="tag">LIFESTYLE</span>
                <h3>Morning Habits for a Productive Mindset</h3>
                <p>Simple routines that can transform your day and bring more clarity.</p>
                <div class="hero-author">
                    <div class="author-info">
                        <img src="https://i.pravatar.cc/100?img=5" alt="Olivia Hart">
                        <span>By Olivia Hart</span>
                    </div>
                    <span class="author-date">May 10, 2024</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Strip -->
    <section class="category-strip">
        <div class="cat-item">
            <div class="cat-icon c1"><i class="far fa-clipboard"></i></div>
            <div class="cat-text">
                <h4>Lifestyle</h4>
                <span>12 Posts</span>
            </div>
        </div>
        <div class="cat-item">
            <div class="cat-icon c2"><i class="fas fa-plane-departure"></i></div>
            <div class="cat-text">
                <h4>Travel</h4>
                <span>10 Posts</span>
            </div>
        </div>
        <div class="cat-item">
            <div class="cat-icon c3"><i class="fas fa-spa"></i></div>
            <div class="cat-text">
                <h4>Personal Growth</h4>
                <span>15 Posts</span>
            </div>
        </div>
        <div class="cat-item">
            <div class="cat-icon c4"><i class="far fa-lightbulb"></i></div>
            <div class="cat-text">
                <h4>Productivity</h4>
                <span>10 Posts</span>
            </div>
        </div>
        <div class="cat-item">
            <div class="cat-icon c5"><i class="fas fa-laptop-code"></i></div>
            <div class="cat-text">
                <h4>Technology</h4>
                <span>14 Posts</span>
            </div>
        </div>
        <div class="cat-item">
            <div class="cat-icon c6"><i class="far fa-heart"></i></div>
            <div class="cat-text">
                <h4>Health</h4>
                <span>11 Posts</span>
            </div>
        </div>
    </section>

    <!-- Latest Articles -->
    <section class="latest-articles mb-16">
        <div class="section-header">
            <h2>Latest Articles</h2>
            <a href="#" class="view-all">View All Articles <i class="fas fa-arrow-right"></i></a>
        </div>

        <div class="latest-grid">
            <!-- Article 1 -->
            <article class="article-card">
                <div class="card-img">
                    <img src="https://images.unsplash.com/photo-1544144433-d50aff500b91?auto=format&fit=crop&q=80&w=600" alt="Coffee">
                </div>
                <div class="card-body">
                    <span class="card-tag">LIFESTYLE</span>
                    <h3>The Power of Slow Mornings</h3>
                    <p>Why slowing down in the morning can set the tone for a better day.</p>
                    <div class="card-footer">
                        <img src="https://i.pravatar.cc/100?img=5" alt="Olivia Hart">
                        <span>By <strong>Olivia Hart</strong> &nbsp;&bull;&nbsp; May 8, 2024</span>
                    </div>
                </div>
            </article>

            <!-- Article 2 -->
            <article class="article-card">
                <div class="card-img">
                    <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&q=80&w=600" alt="Lake">
                </div>
                <div class="card-body">
                    <span class="card-tag">TRAVEL</span>
                    <h3>10 Hidden Gems You Must Visit</h3>
                    <p>Off-the-beaten-path destinations worth adding to your bucket list.</p>
                    <div class="card-footer">
                        <img src="https://i.pravatar.cc/100?img=11" alt="Liam Carter">
                        <span>By <strong>Liam Carter</strong> &nbsp;&bull;&nbsp; May 6, 2024</span>
                    </div>
                </div>
            </article>

            <!-- Article 3 -->
            <article class="article-card">
                <div class="card-img">
                    <img src="https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?auto=format&fit=crop&q=80&w=600" alt="Desk">
                </div>
                <div class="card-body">
                    <span class="card-tag">PRODUCTIVITY</span>
                    <h3>How to Stay Focused in a Distracted World</h3>
                    <p>Practical tips to improve focus and get more done with less stress.</p>
                    <div class="card-footer">
                        <img src="https://i.pravatar.cc/100?img=5" alt="Olivia Hart">
                        <span>By <strong>Olivia Hart</strong> &nbsp;&bull;&nbsp; May 4, 2024</span>
                    </div>
                </div>
            </article>

            <!-- Article 4 -->
            <article class="article-card">
                <div class="card-img">
                    <img src="https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&q=80&w=600" alt="Plant">
                </div>
                <div class="card-body">
                    <span class="card-tag">PERSONAL GROWTH</span>
                    <h3>Becoming the Best Version of You</h3>
                    <p>Small steps every day lead to big changes over time.</p>
                    <div class="card-footer">
                        <img src="https://i.pravatar.cc/100?img=9" alt="Emma Lawson">
                        <span>By <strong>Emma Lawson</strong> &nbsp;&bull;&nbsp; May 2, 2024</span>
                    </div>
                </div>
            </article>
        </div>
    </section>

</div>
@endsection
