document.addEventListener('DOMContentLoaded', () => {
    // 1. Dark Mode Toggle
    const themeToggleBtn = document.getElementById('theme-toggle');
    const htmlElement = document.documentElement;

    // Check saved theme or system preference
    const savedTheme = localStorage.getItem('magzin_theme');
    if (savedTheme) {
        htmlElement.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme === 'dark');
    } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        htmlElement.setAttribute('data-theme', 'dark');
        updateThemeIcon(true);
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const isDark = htmlElement.getAttribute('data-theme') === 'dark';
            if (isDark) {
                htmlElement.removeAttribute('data-theme');
                localStorage.setItem('magzin_theme', 'light');
                updateThemeIcon(false);
            } else {
                htmlElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('magzin_theme', 'dark');
                updateThemeIcon(true);
            }
        });
    }

    function updateThemeIcon(isDark) {
        if (!themeToggleBtn) return;
        themeToggleBtn.innerHTML = isDark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
    }

    // 2. Breaking News Ticker Carousel
    const tickerTextElem = document.getElementById('ticker-headline');
    const tickerPrevBtn = document.getElementById('ticker-prev');
    const tickerNextBtn = document.getElementById('ticker-next');
    
    if (window.breakingNewsList && window.breakingNewsList.length > 0 && tickerTextElem) {
        let tickerIndex = 0;
        
        function updateTicker(index) {
            tickerTextElem.style.opacity = '0';
            setTimeout(() => {
                tickerTextElem.textContent = window.breakingNewsList[index];
                tickerTextElem.style.opacity = '1';
            }, 200);
        }

        if (tickerNextBtn) {
            tickerNextBtn.addEventListener('click', () => {
                tickerIndex = (tickerIndex + 1) % window.breakingNewsList.length;
                updateTicker(tickerIndex);
            });
        }

        if (tickerPrevBtn) {
            tickerPrevBtn.addEventListener('click', () => {
                tickerIndex = (tickerIndex - 1 + window.breakingNewsList.length) % window.breakingNewsList.length;
                updateTicker(tickerIndex);
            });
        }

        // Auto rotate every 5 seconds
        setInterval(() => {
            tickerIndex = (tickerIndex + 1) % window.breakingNewsList.length;
            updateTicker(tickerIndex);
        }, 5000);
    }

    // 3. Dynamic Date in Top Bar
    const liveDateElem = document.getElementById('live-date');
    if (liveDateElem) {
        const options = { month: 'long', day: 'numeric', year: 'numeric' };
        liveDateElem.textContent = new Date().toLocaleDateString('en-US', options);
    }

    // 4. Interactive Bookmarks
    const bookmarkBtns = document.querySelectorAll('.btn-bookmark');
    bookmarkBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            btn.classList.toggle('bookmarked');
            const icon = btn.querySelector('i');
            if (btn.classList.contains('bookmarked')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                showToast('Article saved to your bookmarks!');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                showToast('Article removed from bookmarks.');
            }
        });
    });

    // 5. Category Pills Filter Interactive State
    const categoryPills = document.querySelectorAll('.category-pill');
    categoryPills.forEach(pill => {
        pill.addEventListener('click', (e) => {
            e.preventDefault();
            categoryPills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
            const categoryName = pill.getAttribute('data-category');
            showToast(`Filtering stories by: ${categoryName}`);
        });
    });

    // 6. Search Modal
    const searchOpenBtn = document.getElementById('search-open-btn');
    const searchModal = document.getElementById('search-modal');
    const searchCloseBtn = document.getElementById('search-close-btn');
    const searchInput = document.getElementById('search-input');
    const searchResults = document.getElementById('search-results');

    if (searchOpenBtn && searchModal) {
        searchOpenBtn.addEventListener('click', () => {
            searchModal.classList.add('active');
            if (searchInput) {
                searchInput.focus();
                renderSearchResults(searchInput.value.trim());
            }
        });

        if (searchCloseBtn) {
            searchCloseBtn.addEventListener('click', () => {
                searchModal.classList.remove('active');
            });
        }

        searchModal.addEventListener('click', (e) => {
            if (e.target === searchModal) {
                searchModal.classList.remove('active');
            }
        });

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                renderSearchResults(e.target.value.trim());
            });
        }
    }

    function renderSearchResults(query) {
        if (!searchResults || !window.allArticlesData) return;
        
        let filtered = window.allArticlesData;
        if (query) {
            filtered = window.allArticlesData.filter(art => 
                art.title.toLowerCase().includes(query.toLowerCase()) || 
                art.category.toLowerCase().includes(query.toLowerCase()) ||
                art.excerpt.toLowerCase().includes(query.toLowerCase())
            );
        }

        if (filtered.length === 0) {
            searchResults.innerHTML = '<div style="padding: 20px; text-align: center; color: var(--text-muted);">No articles found matching your query.</div>';
            return;
        }

        searchResults.innerHTML = filtered.map(art => `
            <a href="/article/${art.slug}" class="search-result-item">
                <img src="${art.image}" alt="${art.title}" class="search-result-thumb">
                <div style="flex: 1;">
                    <div style="font-size: 11px; font-weight: 700; color: var(--c-teal); text-transform: uppercase;">${art.category}</div>
                    <div style="font-weight: 700; font-size: 14px; color: var(--text-main); margin-top: 2px;">${art.title}</div>
                    <div style="font-size: 12px; color: var(--text-muted);">${art.date} • ${art.read_time}</div>
                </div>
                <i class="fas fa-chevron-right" style="font-size: 12px; color: var(--text-muted);"></i>
            </a>
        `).join('');
    }

    // 7. Video Modal Preview
    const videoBtns = document.querySelectorAll('.video-play-btn');
    const videoModal = document.getElementById('video-modal');
    const videoCloseBtn = document.getElementById('video-close-btn');

    videoBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            if (videoModal) {
                videoModal.classList.add('active');
            }
        });
    });

    if (videoCloseBtn && videoModal) {
        videoCloseBtn.addEventListener('click', () => {
            videoModal.classList.remove('active');
            const iframe = videoModal.querySelector('iframe');
            if (iframe) {
                const src = iframe.src;
                iframe.src = src; // reset video playback
            }
        });

        videoModal.addEventListener('click', (e) => {
            if (e.target === videoModal) {
                videoModal.classList.remove('active');
                const iframe = videoModal.querySelector('iframe');
                if (iframe) {
                    const src = iframe.src;
                    iframe.src = src;
                }
            }
        });
    }

    // 8. Toast Helper
    function showToast(message) {
        let toast = document.getElementById('app-toast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'app-toast';
            toast.className = 'toast-alert';
            document.body.appendChild(toast);
        }
        toast.innerHTML = `<i class="fas fa-check-circle"></i> <span>${message}</span>`;
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 3000);
    }
});
