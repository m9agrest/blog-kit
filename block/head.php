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
        /* Общие стили для всех типов постов */
        .post, .father-post, .children-post {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .post-author {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .post-author img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .post-content p {
            font-size: 14px;
            line-height: 1.6;
        }

        .post-content img {
            max-width: 100%;
            margin-top: 10px;
        }

        .post-date {
            font-size: 12px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .post-author a{
            text-decoration: none;
        }

        .post-content a{
            text-decoration: none;
        }

        /* Стили для обычных постов */
        .post {
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Стили для постов-отцов */
        .father-post {
            background-color: #e8f4f8;
            border-left: 4px solid #007bff;
        }

        .father-post .post-author a {
            color: #007bff;
        }

        /* Стили для постов-детей */
        .children-post {
            background-color: #f1f9f4;
            padding-left: 40px;
            border-left: 4px solid #28a745;
        }

        .children-post .post-author a {
            color: #28a745;
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