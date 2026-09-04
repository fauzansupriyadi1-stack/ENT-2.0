/**
 * Blogr. Modern Interactive JavaScript
 * Includes: Navigation, Filtering, Search, Bookmarks, Likes, Modals, Toasts
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. All Articles Dataset for Search & Modal Preview
    const articlesData = [
        {
            id: 1,
            title: "The Power of Slow Mornings",
            category: "Lifestyle",
            tag: "lifestyle",
            date: "May 8, 2024",
            readTime: "4 min read",
            author: "Olivia Hart",
            authorRole: "Editor in Chief",
            authorAvatar: "https://i.pravatar.cc/100?img=5",
            image: "https://images.unsplash.com/photo-1544144433-d50aff500b91?auto=format&fit=crop&q=80&w=800",
            excerpt: "Why slowing down and giving yourself quiet breathing room sets a resilient tone for the rest of your busy day.",
            content: `
                <p>In our hyper-connected world, waking up to a storm of notifications has become the default setting for millions. We jump out of bed already reacting to emails, headlines, and demands from others.</p>
                <p>A slow morning isn't about being unproductive or lazy—it is about reclaiming deliberate agency over the first hour of your waking consciousness. When you protect your morning tranquility, you cultivate cognitive resilience that carries through stressful afternoon meetings.</p>
                <blockquote>"How you spend the first hour of your day determines the emotional tone of all that follows."</blockquote>
                <p>Try small rituals: brewing tea without looking at a screen, stretching by a window, journaling three thoughts of gratitude, or reading five pages of a book. The difference in mental clarity is immediate and profound.</p>
            `
        },
        {
            id: 2,
            title: "10 Hidden Gems You Must Visit",
            category: "Travel",
            tag: "travel",
            date: "May 6, 2024",
            readTime: "6 min read",
            author: "Liam Carter",
            authorRole: "Travel Journalist",
            authorAvatar: "https://i.pravatar.cc/100?img=11",
            image: "https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&q=80&w=800",
            excerpt: "Off-the-beaten-path destinations across mountain valleys and coastlines worth adding to your travel bucket list.",
            content: `
                <p>Overtourism has changed how we experience world-famous landmarks. Yet, right beside congested hotspots lie secluded mountain lakes, forgotten fishing hamlets, and lush forest valleys that retain authentic charm.</p>
                <p>Traveling with an explorer's curiosity means looking past the top 10 algorithmic recommendations. It invites you into local bakeries where recipes have stayed unchanged for generations, and silent scenic trails where the only sound is wind rustling through pine trees.</p>
            `
        },
        {
            id: 3,
            title: "How to Stay Focused in a Distracted World",
            category: "Productivity",
            tag: "productivity",
            date: "May 4, 2024",
            readTime: "5 min read",
            author: "Olivia Hart",
            authorRole: "Editor in Chief",
            authorAvatar: "https://i.pravatar.cc/100?img=5",
            image: "https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?auto=format&fit=crop&q=80&w=800",
            excerpt: "Practical environmental tweaks and cognitive frameworks to improve deep work and get more done with less stress.",
            content: `
                <p>Deep work is becoming a rare and super-valuable superpower. Every time your phone lights up or a tab sends an audio chime, your brain experiences attentional residue, costing up to 20 minutes to recover high-level concentration.</p>
                <p>By batching communication windows into two fixed slots per day and designing frictionless workspaces devoid of visual clutter, you unlock uninterrupted blocks of creative momentum.</p>
            `
        },
        {
            id: 4,
            title: "Becoming the Best Version of You",
            category: "Personal Growth",
            tag: "personal-growth",
            date: "May 2, 2024",
            readTime: "7 min read",
            author: "Emma Lawson",
            authorRole: "Wellness Coach",
            authorAvatar: "https://i.pravatar.cc/100?img=9",
            image: "https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&q=80&w=800",
            excerpt: "Small deliberate steps practiced consistently every day lead to compounding positive transformations over time.",
            content: `
                <p>We often obsess over massive overnight breakthroughs. However, lasting personal evolution is rooted in micro-habits—the tiny 1% decisions you make when no one is watching.</p>
                <p>Compassion for your current self paired with steady curiosity about what you can learn next creates a healthy, sustainable trajectory of self-mastery.</p>
            `
        },
        {
            id: 5,
            title: "Designing Minimalist Digital Tools",
            category: "Technology",
            tag: "technology",
            date: "Apr 29, 2024",
            readTime: "5 min read",
            author: "Marcus Vance",
            authorRole: "Product Designer",
            authorAvatar: "https://i.pravatar.cc/100?img=12",
            image: "https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=800",
            excerpt: "How modern software creators are eliminating interface clutter to build intentional, human-centered experiences.",
            content: `
                <p>In the golden age of feature bloat, minimalist design is a breath of fresh air. Intentional software respects the user's finite mental bandwidth rather than constantly fighting for ad impressions.</p>
            `
        },
        {
            id: 6,
            title: "Creating a Peaceful Living Space",
            category: "Lifestyle",
            tag: "lifestyle",
            date: "Apr 26, 2024",
            readTime: "4 min read",
            author: "Olivia Hart",
            authorRole: "Editor in Chief",
            authorAvatar: "https://i.pravatar.cc/100?img=5",
            image: "https://images.unsplash.com/photo-1507652313519-d4e9174996dd?auto=format&fit=crop&q=80&w=800",
            excerpt: "Decluttering principles and interior accents that transform your home into a calm sanctuary for recharge.",
            content: `
                <p>Our physical environment constantly whispers to our subconscious. A space filled with natural daylight, subtle botanical greens, and curated textures acts as an emotional refuge after high-velocity workdays.</p>
            `
        },
        {
            id: 7,
            title: "The Rule of Three Priorities",
            category: "Productivity",
            tag: "productivity",
            date: "Apr 22, 2024",
            readTime: "4 min read",
            author: "Liam Carter",
            authorRole: "Travel Journalist",
            authorAvatar: "https://i.pravatar.cc/100?img=11",
            image: "https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=800",
            excerpt: "A timeless system for picking just three major tasks each day to eliminate overwhelm and guarantee momentum.",
            content: `
                <p>When everything is a priority, nothing is. Limiting your daily mission list to just 3 essential outcomes forces strategic prioritization and eliminates chronic end-of-day guilt.</p>
            `
        },
        {
            id: 8,
            title: "Mindfulness for Busy Schedules",
            category: "Personal Growth",
            tag: "personal-growth",
            date: "Apr 18, 2024",
            readTime: "6 min read",
            author: "Emma Lawson",
            authorRole: "Wellness Coach",
            authorAvatar: "https://i.pravatar.cc/100?img=9",
            image: "https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&q=80&w=800",
            excerpt: "How to find micro-moments of stillness and presence during intense workdays without needing hours of quiet.",
            content: `
                <p>Mindfulness is not confined to a meditation cushion on a retreat. Taking three deep diaphragmatic breaths before clicking into a tense call is a real-time mindfulness practice that resets your autonomic nervous system.</p>
            `
        }
    ];

    // 2. Reading Progress & Header Scroll Shadow & Back to Top
    const scrollProgress = document.getElementById('scroll-progress');
    const mainHeader = document.getElementById('main-header');
    const backToTopBtn = document.getElementById('back-to-top');

    window.addEventListener('scroll', () => {
        const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        
        if (scrollProgress) {
            scrollProgress.style.width = scrolled + '%';
        }

        if (mainHeader) {
            if (winScroll > 20) {
                mainHeader.classList.add('scrolled');
            } else {
                mainHeader.classList.remove('scrolled');
            }
        }

        if (backToTopBtn) {
            if (winScroll > 350) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        }
    });

    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // 3. Mobile Navigation Drawer
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileDrawer = document.getElementById('mobile-drawer');
    const mobileOverlay = document.getElementById('mobile-overlay');
    const mobileDrawerClose = document.getElementById('mobile-drawer-close');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

    function openMobileMenu() {
        if (mobileDrawer && mobileOverlay && mobileMenuToggle) {
            mobileDrawer.classList.add('open');
            mobileOverlay.classList.add('open');
            mobileMenuToggle.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeMobileMenu() {
        if (mobileDrawer && mobileOverlay && mobileMenuToggle) {
            mobileDrawer.classList.remove('open');
            mobileOverlay.classList.remove('open');
            mobileMenuToggle.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', () => {
            if (mobileDrawer.classList.contains('open')) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }

    if (mobileDrawerClose) mobileDrawerClose.addEventListener('click', closeMobileMenu);
    if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobileMenu);

    mobileNavLinks.forEach(link => {
        link.addEventListener('click', () => {
            closeMobileMenu();
        });
    });

    // 4. Category Interactive Filter
    const catButtons = document.querySelectorAll('.cat-item');
    const articleCards = document.querySelectorAll('.article-card');
    const activeFilterLabel = document.getElementById('active-filter-label');
    const resetFilterBtn = document.getElementById('reset-filter-btn');
    const noResultsState = document.getElementById('no-filter-results');
    const articlesGrid = document.getElementById('articles-grid');

    catButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const category = btn.getAttribute('data-category');
            
            // Set active class
            catButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            filterArticles(category);
        });
    });

    function filterArticles(category) {
        let visibleCount = 0;

        articleCards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            if (category === 'all' || cardCat === category) {
                card.style.display = 'flex';
                card.style.opacity = '0';
                card.style.transform = 'translateY(12px)';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 50);
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update Label
        if (activeFilterLabel) {
            const displayCatName = category === 'all' ? 'All Articles' : formatCatName(category);
            activeFilterLabel.innerHTML = `Showing <strong>${displayCatName}</strong> (${visibleCount})`;
        }

        if (resetFilterBtn) {
            resetFilterBtn.style.display = category === 'all' ? 'none' : 'inline-flex';
        }

        if (noResultsState) {
            noResultsState.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        if (category !== 'all') {
            showToast(`Filtered by ${formatCatName(category)} (${visibleCount} stories)`);
        }
    }

    function formatCatName(cat) {
        return cat.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
    }

    if (resetFilterBtn) {
        resetFilterBtn.addEventListener('click', () => {
            const allBtn = document.querySelector('.cat-item[data-category="all"]');
            if (allBtn) allBtn.click();
        });
    }

    const showAllBtn = document.getElementById('btn-show-all-articles');
    if (showAllBtn) {
        showAllBtn.addEventListener('click', () => {
            const allBtn = document.querySelector('.cat-item[data-category="all"]');
            if (allBtn) allBtn.click();
        });
    }

    // Category Strip Scroll Buttons (Prev/Next)
    const catStrip = document.getElementById('category-strip');
    const catPrev = document.getElementById('cat-prev');
    const catNext = document.getElementById('cat-next');

    if (catPrev && catStrip) {
        catPrev.addEventListener('click', () => {
            catStrip.scrollBy({ left: -220, behavior: 'smooth' });
        });
    }

    if (catNext && catStrip) {
        catNext.addEventListener('click', () => {
            catStrip.scrollBy({ left: 220, behavior: 'smooth' });
        });
    }

    // 5. Interactive Likes & Bookmarks
    document.addEventListener('click', (e) => {
        // Like Button
        const likeBtn = e.target.closest('.btn-like');
        if (likeBtn) {
            e.preventDefault();
            e.stopPropagation();
            likeBtn.classList.toggle('liked');
            const countSpan = likeBtn.querySelector('.like-count');
            const rawId = likeBtn.getAttribute('data-id') || '1';
            const artId = rawId.replace(/\D/g, '') || '1';

            if (countSpan) {
                let current = parseInt(countSpan.textContent) || 0;
                if (likeBtn.classList.contains('liked')) {
                    countSpan.textContent = current + 1;
                    showToast('❤️ Disukai! Data disinkronkan ke server...');
                    fetch('/api/articles/' + artId + '/like', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).catch(err => console.log(err));
                } else {
                    countSpan.textContent = Math.max(0, current - 1);
                    showToast('Batal menyukai artikel.');
                }
            }
            return;
        }

        // Bookmark Button
        const bookmarkBtn = e.target.closest('.btn-bookmark');
        if (bookmarkBtn) {
            e.preventDefault();
            e.stopPropagation();
            bookmarkBtn.classList.toggle('bookmarked');
            const icon = bookmarkBtn.querySelector('i');
            if (bookmarkBtn.classList.contains('bookmarked')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                showToast('🔖 Saved to your personal reading list!');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                showToast('Removed from reading list.');
            }
            return;
        }

        // Article Detail Modal Trigger
        const articleTrigger = e.target.closest('.article-detail-trigger') || e.target.closest('.card-img-wrap');
        if (articleTrigger) {
            const card = e.target.closest('.article-card');
            if (card) {
                e.preventDefault();
                const artId = parseInt(card.getAttribute('data-id'));
                openArticleModal(artId);
            }
        }
    });

    // 6. Article Quick-Read Modal
    const articleModal = document.getElementById('article-modal');
    const articleModalBackdrop = document.getElementById('article-modal-backdrop');
    const articleModalClose = document.getElementById('article-modal-close');
    const articleModalContent = document.getElementById('article-modal-content');

    function openArticleModal(id) {
        const article = articlesData.find(a => a.id === id) || articlesData[0];
        if (!articleModal || !articleModalContent) return;

        articleModalContent.innerHTML = `
            <div style="position: relative;">
                <img src="${article.image}" alt="${article.title}" style="width: 100%; height: 320px; object-fit: cover; border-top-left-radius: 24px; border-top-right-radius: 24px;">
            </div>
            <div style="padding: 32px 36px;">
                <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 12px;">
                    <span class="tag-new" style="background-color: var(--c-light-green); color: var(--c-teal); font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 20px;">${article.category}</span>
                    <span style="font-size: 13px; color: var(--c-text-muted);"><i class="far fa-clock"></i> ${article.readTime}</span>
                    <span style="font-size: 13px; color: var(--c-text-muted);">&bull; ${article.date}</span>
                </div>
                <h2 style="font-family: var(--font-serif); font-size: 32px; line-height: 1.25; margin-bottom: 20px; color: var(--c-text-main);">${article.title}</h2>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 28px; padding-bottom: 20px; border-bottom: 1px solid var(--c-border);">
                    <img src="${article.authorAvatar}" alt="${article.author}" style="width: 44px; height: 44px; border-radius: 50%; object-fit: cover;">
                    <div>
                        <strong style="display: block; font-size: 15px;">${article.author}</strong>
                        <span style="font-size: 12px; color: var(--c-text-muted);">${article.authorRole}</span>
                    </div>
                </div>
                <div style="font-size: 16px; line-height: 1.8; color: #333333;">
                    ${article.content}
                </div>
                <div style="margin-top: 36px; padding-top: 24px; border-top: 1px solid var(--c-border); display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; gap: 12px;">
                        <button class="btn-like liked" style="background-color: var(--c-teal-light); color: var(--c-teal); padding: 8px 16px; border-radius: 20px; font-weight: 600;">
                            <i class="fas fa-heart" style="color: #e53935; margin-right: 6px;"></i> Applaud
                        </button>
                        <button class="btn-outline" onclick="showToast('Story link copied to clipboard!');" style="padding: 8px 16px; font-size: 13px;">
                            <i class="fas fa-share-alt" style="margin-right: 6px;"></i> Share
                        </button>
                    </div>
                    <button class="btn-primary" onclick="document.getElementById('article-modal-close').click();" style="padding: 10px 20px; font-size: 14px;">
                        Done Reading
                    </button>
                </div>
            </div>
        `;

        articleModal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeArticleModal() {
        if (articleModal) {
            articleModal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    if (articleModalClose) articleModalClose.addEventListener('click', closeArticleModal);
    if (articleModalBackdrop) articleModalBackdrop.addEventListener('click', closeArticleModal);

    // 7. Search Modal & Realtime Search
    const searchOpenBtn = document.getElementById('search-open-btn');
    const searchModal = document.getElementById('search-modal');
    const searchModalBackdrop = document.getElementById('search-modal-backdrop');
    const searchModalClose = document.getElementById('search-modal-close');
    const globalSearchInput = document.getElementById('global-search-input');
    const searchClearBtn = document.getElementById('search-clear-btn');
    const searchResultsList = document.getElementById('search-results-list');
    const quickTagPills = document.querySelectorAll('.quick-tag-pill');

    function openSearchModal() {
        if (searchModal) {
            searchModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            if (globalSearchInput) {
                globalSearchInput.focus();
                renderSearchResults(globalSearchInput.value.trim());
            }
        }
    }

    function closeSearchModal() {
        if (searchModal) {
            searchModal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    if (searchOpenBtn) searchOpenBtn.addEventListener('click', openSearchModal);
    if (searchModalClose) searchModalClose.addEventListener('click', closeSearchModal);
    if (searchModalBackdrop) searchModalBackdrop.addEventListener('click', closeSearchModal);

    // Keyboard shortcut: Ctrl+K or / to search, Esc to close
    document.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            openSearchModal();
        } else if (e.key === 'Escape') {
            closeSearchModal();
            closeArticleModal();
            closeSubscribeModal();
            closeMobileMenu();
        }
    });

    if (globalSearchInput) {
        globalSearchInput.addEventListener('input', (e) => {
            const query = e.target.value.trim();
            if (searchClearBtn) {
                searchClearBtn.style.display = query ? 'block' : 'none';
            }
            renderSearchResults(query);
        });
    }

    if (searchClearBtn) {
        searchClearBtn.addEventListener('click', () => {
            if (globalSearchInput) {
                globalSearchInput.value = '';
                searchClearBtn.style.display = 'none';
                globalSearchInput.focus();
                renderSearchResults('');
            }
        });
    }

    quickTagPills.forEach(pill => {
        pill.addEventListener('click', () => {
            const query = pill.getAttribute('data-query');
            if (globalSearchInput) {
                globalSearchInput.value = query;
                if (searchClearBtn) searchClearBtn.style.display = 'block';
                renderSearchResults(query);
            }
        });
    });

    function renderSearchResults(query) {
        if (!searchResultsList) return;

        let matches = articlesData;
        if (query) {
            const q = query.toLowerCase();
            matches = articlesData.filter(item => 
                item.title.toLowerCase().includes(q) ||
                item.category.toLowerCase().includes(q) ||
                item.excerpt.toLowerCase().includes(q) ||
                item.author.toLowerCase().includes(q)
            );
        }

        if (matches.length === 0) {
            searchResultsList.innerHTML = `
                <div style="text-align: center; padding: 30px 10px; color: var(--c-text-muted);">
                    <i class="fas fa-search" style="font-size: 24px; color: var(--c-text-light); margin-bottom: 10px; display: block;"></i>
                    <p style="font-size: 14px;">No matching stories found for "<strong>${query}</strong>".</p>
                    <span style="font-size: 12px; color: var(--c-text-light);">Try searching for Lifestyle, Morning, or Focus.</span>
                </div>
            `;
            return;
        }

        searchResultsList.innerHTML = matches.map(art => `
            <div class="search-result-item" data-id="${art.id}">
                <img src="${art.image}" alt="${art.title}" class="search-result-thumb">
                <div style="flex: 1; min-width: 0;">
                    <div style="font-size: 10.5px; font-weight: 700; color: var(--c-teal); text-transform: uppercase;">${art.category}</div>
                    <div style="font-weight: 600; font-size: 14px; color: var(--c-text-main); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${art.title}</div>
                    <div style="font-size: 11.5px; color: var(--c-text-muted);">${art.author} &bull; ${art.readTime}</div>
                </div>
                <i class="fas fa-arrow-right" style="font-size: 12px; color: var(--c-teal); margin-left: 8px;"></i>
            </div>
        `).join('');

        // Attach click listeners to search results
        searchResultsList.querySelectorAll('.search-result-item').forEach(item => {
            item.addEventListener('click', () => {
                const id = parseInt(item.getAttribute('data-id'));
                closeSearchModal();
                setTimeout(() => openArticleModal(id), 150);
            });
        });
    }

    // 8. Subscribe Modals & Forms
    const subscribeOpenBtn = document.getElementById('subscribe-open-btn');
    const mobileSubscribeBtn = document.getElementById('mobile-subscribe-btn');
    const subscribeModal = document.getElementById('subscribe-modal');
    const subscribeModalBackdrop = document.getElementById('subscribe-modal-backdrop');
    const subscribeModalClose = document.getElementById('subscribe-modal-close');
    const subscribeForm = document.getElementById('subscribe-form');
    const footerForm = document.getElementById('footer-newsletter-form');
    const bannerForm = document.getElementById('banner-newsletter-form');

    function openSubscribeModal() {
        if (subscribeModal) {
            subscribeModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            const emailIn = document.getElementById('subscribe-email');
            if (emailIn) emailIn.focus();
        }
    }

    function closeSubscribeModal() {
        if (subscribeModal) {
            subscribeModal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    if (subscribeOpenBtn) subscribeOpenBtn.addEventListener('click', openSubscribeModal);
    if (mobileSubscribeBtn) {
        mobileSubscribeBtn.addEventListener('click', () => {
            closeMobileMenu();
            openSubscribeModal();
        });
    }

    document.querySelectorAll('.btn-open-modal[data-modal="subscribe-modal"]').forEach(btn => {
        btn.addEventListener('click', openSubscribeModal);
    });

    if (subscribeModalClose) subscribeModalClose.addEventListener('click', closeSubscribeModal);
    if (subscribeModalBackdrop) subscribeModalBackdrop.addEventListener('click', closeSubscribeModal);

    function handleSubscribeSubmit(inputElement) {
        const email = inputElement ? inputElement.value.trim() : '';
        if (email && email.includes('@')) {
            closeSubscribeModal();
            if (inputElement) inputElement.value = '';
            showToast(`🎉 You're in! Confirmation sent to ${email}`);
        } else {
            showToast('⚠️ Please enter a valid email address.');
        }
    }

    if (subscribeForm) {
        subscribeForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleSubscribeSubmit(document.getElementById('subscribe-email'));
        });
    }

    if (footerForm) {
        footerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleSubscribeSubmit(document.getElementById('footer-email-input'));
        });
    }

    if (bannerForm) {
        bannerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleSubscribeSubmit(document.getElementById('banner-email-input'));
        });
    }

    // 9. Toast Notification System
    window.showToast = function(message) {
        const toastContainer = document.getElementById('toast-container');
        if (!toastContainer) return;

        const toast = document.createElement('div');
        toast.className = 'toast-alert';
        toast.innerHTML = `<i class="fas fa-check-circle"></i> <span>${message}</span>`;
        toastContainer.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(10px)';
            toast.style.transition = 'all 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3200);
    };

    document.querySelectorAll('.btn-open-toast').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const msg = btn.getAttribute('data-msg') || 'Action completed successfully!';
            showToast(msg);
        });
    });

    // 10. Smooth Scroll for hash anchor links
    document.querySelectorAll('.scroll-link').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.startsWith('#') && href.length > 1) {
                const targetElem = document.querySelector(href);
                if (targetElem) {
                    e.preventDefault();
                    targetElem.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });
});
