<?php
// You can pass any necessary PHP variables here
?>

<header class="header">
    <div class="header-container">
        <!-- Left: Menu button (mobile) and logo -->
        <div class="header-left">
            <button
                type="button"
                class="mobile-menu-button"
                onclick="<?= htmlspecialchars($setSidebarOpen(true)) ?>">
                <svg class="menu-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Center: Search bar -->
        <div class="header-search">
            <div class="search-container">
                <div class="search-icon-container">
                    <svg class="search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input
                    type="text"
                    class="search-input"
                    placeholder="Search for partners, skills, or research topics..." />
            </div>
        </div>

        <!-- Right: Navigation icons -->
        <div class="header-right">
            <button class="notification-button">
                <svg class="notification-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="notification-badge"></span>
            </button>

            <button class="message-button">
                <svg class="message-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <span class="message-badge"></span>
            </button>

            <div class="profile-dropdown">
                <button type="button" class="profile-button">
                    <div class="profile-avatar">
                        <svg class="user-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </button>
            </div>
        </div>
    </div>
</header>