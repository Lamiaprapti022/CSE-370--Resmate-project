<?php
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <style>
        .header {
            height: 65px;
            width: 100%;
            background-color: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .header-container {
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .search-container {
            flex: 1;
            max-width: 28rem;
            margin: 0 1rem 0 32%;
        }

        .search-input-container {
            position: relative;
        }

        .search-icon-container {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            padding-left: 0.75rem;
            display: flex;
            align-items: center;
            pointer-events: none;
        }

        .search-input {
            display: block;
            width: 100%;
            border-radius: 9999px;
            border: 1px solid #d1d5db;
            padding-left: 2.5rem;
            padding-right: 1rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: #f3f4f6;
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .search-input:focus {
            background-color: white;
            outline: none;
            border-color: #4287f5;
            box-shadow: 0 0 0 2px #4287f5;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 1rem;
            position: relative;
        }

        .user-button-profile {
            display: flex;
            align-items: center;
            max-width: 2rem;
            border-radius: 9999px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .user-avatar {
            height: 2rem;
            width: 2rem;
            border-radius: 9999px;
            background-color: #4287f5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .search-logo {
            opacity: 0.5;
            height: 25px;
            width: 25px;
        }

        .dropdown-menu {
            position: absolute;
            top: 110%;
            right: 0;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 0.5rem 0;
            display: none;
            z-index: 999;
            width: 150px;
            opacity: 0;
        }

        .dropdown-menu.show {
            display: block;
            animation: fadeSlideDown 0.3s ease-out forwards;
        }

        .dropdown-menu a {
            display: block;
            padding: 0.5rem 1rem;
            color: #333;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .dropdown-menu a:hover {
            background-color: #f3f3f3;
        }

        @keyframes fadeSlideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="search-container">
                <div class="search-input-container">
                    <div class="search-icon-container">
                        <img src="images/navitems_svgs/search-svgrepo-com.svg" alt="search icon" class="search-logo" />
                    </div>
                    <input type="text" class="search-input" placeholder="Search for partners, skills, or research topics...">
                </div>
            </div>

            <div class="action-buttons">
                <div class="relative">
                    <button type="button" class="user-button-profile" onclick="toggleDropdown()">
                        <div class="user-avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                    </button>
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="profile.php">Profile</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script>
        function toggleDropdown() {
            const menu = document.getElementById("dropdownMenu");
            if (menu.classList.contains("show")) {
                menu.classList.remove("show");
                setTimeout(() => {
                    menu.style.display = "none";
                    menu.style.opacity = 0;
                }, 200);
            } else {
                menu.style.display = "block";
                setTimeout(() => {
                    menu.classList.add("show");
                }, 10);
            }
        }

        window.addEventListener("click", function(e) {
            const dropdown = document.getElementById("dropdownMenu");
            const button = document.querySelector(".user-button-profile");
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.remove("show");
                setTimeout(() => {
                    dropdown.style.display = "none";
                    dropdown.style.opacity = 0;
                }, 200);
            }
        });
    </script>
</body>
</html>';
?>
