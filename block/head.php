<head>
	<title><?= htmlspecialchars($title) ?></title>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const postDateElements = document.querySelectorAll(".post-date");

            postDateElements.forEach(function(element) {
                const timestamp = parseInt(element.getAttribute("data-timestamp"));
                const date = new Date(timestamp * 1000); // Преобразуем Unix timestamp в миллисекунды

                // Преобразуем дату в формат для пользователя (например, "DD-MM-YYYY HH:mm")
                const formattedDate = date.toLocaleString("ru-RU", {
                    weekday: "short",
                    year: "numeric",
                    month: "short",
                    day: "numeric",
                    hour: "2-digit",
                    minute: "2-digit"
                });

                element.innerHTML += formattedDate;
            });
        });
    </script>
    <!--Стили нумерации-->
    <style>
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination .page,
        .pagination .current,
        .pagination .dots {
            margin: 0 5px;
            padding: 5px 10px;
            text-decoration: none;
        }
        .pagination .current {
            font-weight: bold;
            background-color: #eee;
            border-radius: 4px;
        }
        .pagination .dots {
            color: #888;
        }
    </style>
    <!--Стили поста-->
    <style>
        .post {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 16px;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            font-family: sans-serif;
        }

        .post-author {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .post-author img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .post-author a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 16px;
        }

        .post-content a.post-date {
            display: inline-block;
            font-size: 12px;
            color: #888;
            margin-bottom: 8px;
            text-decoration: none;
        }

        .post-content p {
            font-size: 15px;
            color: #222;
            margin: 10px 0;
            line-height: 1.5;
        }

        .post-content img {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 10px 0;
            border-radius: 8px;
        }

        .post-content p:last-child {
            font-size: 14px;
            color: #666;
        }
    </style>
    <!--Стили профиля-->
    <style>
        .profile {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            margin-bottom: 30px;
            background: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ccc;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .profile-info span {
            font-size: 16px;
            color: #333;
        }

        .profile-info span:first-child {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
    <!--Стили заголовка-->
    <style>
        header {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 20px;
            padding: 16px 32px;
            background-color: #ffffff;
            border-bottom: 1px solid #e0e0e0;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        header a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            font-size: 16px;
            padding: 6px 10px;
            border-radius: 6px;
            transition: background-color 0.2s, color 0.2s;
        }

        header a:hover {
            background-color: #f2f2f2;
            color: #000;
        }
    </style>
</head>