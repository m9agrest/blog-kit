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
</head>