<x-layouts.client-layout title="{{ $post->title }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;1,700&family=Roboto:wght@500;700&display=swap');



        html {
            font-size: 15px;
        }



        #article_container {
            width: 80%;
            max-width: 1000px;
            height: auto;
            min-height: 608px;
            margin: 0 auto;
            margin-top: 56px;
            background-color: #000;
            box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.15);
            display: flex;
        }

        .article_container_img {
            flex-grow: 1;
            min-width: 50%;
            background-color: #000;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .article_container_content {
            flex-grow: 1;
            padding: 55px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1 {
            font-size: 3rem;
            font-weight: 600;
            color: #d4dcea;
            font-family: 'Roboto', sans-serif;
            text-align: center;
        }

        .the {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        h4 {
            font-size: 1.125rem;
            font-weight: 600;
            font-family: 'PT Serif', serif;
            font-style: italic;
            margin: 0 16px;
        }

        p {
            font-family: 'PT Serif', serif;
            font-size: 1.125rem;
            color: #b1c1d4;
            text-align: center;
            line-height: 36px;
        }





        .divider {
            width: 60px;
            height: 4px;
            background-color: #c7cdd3;
            margin: 40px 0;
        }

        .line {
            width: 35px;
            height: 1px;
            background-color: #dadde1;
        }

        @media (max-width: 768px) {
            #article_container {
                flex-wrap: wrap;
                width: 100%;
                margin-top: 0;
            }

            .article_container_img {
                width: 100%;
                height: 608px;
            }

            .article_container_content {
                width: 100%;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            #article_container {
                flex-wrap: wrap;
            }

            .article_container_img {
                width: 100%;
                height: 608px;
            }

            .article_container_content {
                width: 100%;
            }
        }
    </style>

    <div class="flex flex-col " style="align-items: center;">
        <div id="article_container" data-post-id="{{ $post->id }}">

            <div class="article_container_content" id="articleContainer">
                <div class="the">
                    <div class="line"></div>
                    <h4>Loading...</h4>
                    <div class="line"></div>
                </div>
                <h1 id="postTitle"></h1>
                <div class="divider"></div>
                <div class="article_container_img">
                    <img src="" alt="" id="postImage">
                    <div id="icon" class="relative bottom-[90%] left-[92%]" id="heartContainer">
                        <img src="" id="icon-heart" alt="" srcset=""
                            style="background: white; border-radius: 15px; padding: 5px">
                    </div>
                </div>
                <p id="postDescription"></p>

            </div>

        </div>
        <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased w-[40%]"
            style="max-height: 700px;overflow-y: auto;border-radius: 10px;margin: 20px auto">
            <div class="max-w-2xl mx-auto px-4">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion</h2>
                </div>
                <form class="mb-6">
                    <div id="textarea"
                        class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <label for="comment" class="sr-only">Your comment</label>
                        <textarea id="comment" rows="6"
                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                            placeholder="Write a comment..." required></textarea>
                    </div>
                    <button type="submit" onclick="addComment(event,{{ $post->id }})"
                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-[#fc444a] rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Post comment
                    </button>
                </form>
                <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900" id="comments">

                </article>

            </div>
        </section>
    </div>


    <script>
        const article_container = document.getElementById('article_container')
        const postId = article_container.getAttribute('data-post-id');
        const serverUrl = 'http://127.0.0.1:8000/'
        fetchcomments();


        function addComment(event, id) {
            event.preventDefault();

            if()



        }

        function fetchcomments() {
            fetch('http://127.0.0.1:8000/api/comments/' + postId, {
                method: 'GET',

            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.status}`);
                    }
                    return response.json();
                })
                .then((data) => {
                    const comments = data.comments;
                    const commentsContainer = document.getElementById('comments');

                    // Clear existing comments
                    commentsContainer.innerHTML = '';

                    comments.forEach((comment) => {
                        const commentItem = document.createElement('div');

                        commentItem.style.cssText = 'display: flex; flex-direction: column; align-items: flex-start;';
                        commentItem.innerHTML = `
                <footer class="flex justify-between items-center mb-2">
                    <div class="flex items-center">
                        <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                            <img class="mr-2 w-6 h-6 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="${comment.user.name}">
                            ${comment.user.name}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <time pubdate datetime="${comment.created_at}" title="${comment.created_at}">
                                ${new Date(comment.created_at).toLocaleDateString()}
                            </time>
                        </p>
                    </div>
                    <button id="dropdownComment${comment.id}Button" data-dropdown-toggle="dropdownComment${comment.id}"
                        class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        type="button">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 16 3">
                            <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                        </svg>
                        <span class="sr-only">Comment settings</span>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownComment${comment.id}"
                        class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Remove</a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                            </li>
                        </ul>
                    </div>
                </footer>
                <p class="text-gray-500 dark:text-gray-400">${comment.content}</p>
            `;

                        commentsContainer.appendChild(commentItem);
                    });
                })
        }

        function displayComments(data) {

        }


        if (localStorage.getItem('token')) {
            fetch('http://127.0.0.1:8000/api/post/' + postId, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${localStorage.getItem('token')}`,
                },
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.status}`);
                    }
                    return response.json();
                })
                .then((data) => {


                    const articleContainer = document.getElementById('articleContainer');
                    const postTitle = document.getElementById('postTitle');
                    const postImage = document.getElementById('postImage');
                    const postDescription = document.getElementById('postDescription');

                    // Update HTML elements with post data
                    postTitle.textContent = data.title;
                    postImage.src = data.image;
                    postDescription.textContent = data.description;

                    const iconHeart = document.getElementById('icon-heart');
                    iconHeart.src = data.isLiked ? serverUrl + 'images/heart2.png' : serverUrl + 'images/heart1.png';

                    iconHeart.addEventListener('click', function () {


                        fetch('http://127.0.0.1:8000/api/favoris/' + data.id, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${localStorage.getItem('token')}`,
                            },
                        })
                            .then((response) => {
                                if (!response.ok) {
                                    throw new Error(`Network response was not ok: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then((data) => {
                                if (data.success === 'like') {
                                    iconHeart.src = serverUrl + 'images/heart2.png'
                                } else if (data.success === 'not like') {
                                    iconHeart.src = serverUrl + 'images/heart1.png'
                                }
                            })
                            .catch((error) => {

                            });
                    });





                })
                .catch((error) => {
                    console.error('Fetch error:', error);
                });
        } else {
            fetch('http://127.0.0.1:8000/post/' + postId, {
                method: 'GET'
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.status}`);
                    }
                    return response.json();
                })
                .then((data) => {
                    const icon = document.getElementById('icon')
                    console.log(icon);
                    // icon.style.display = 'none';
                    icon.classList.add('hidden');


                    const articleContainer = document.getElementById('articleContainer');
                    const postTitle = document.getElementById('postTitle');
                    const postImage = document.getElementById('postImage');
                    const postDescription = document.getElementById('postDescription');

                    // Update HTML elements with post data
                    postTitle.textContent = data.title;
                    postImage.src = data.image;
                    postDescription.textContent = data.description;






                })
                .catch((error) => {
                    console.error('Fetch error:', error);
                });
        }
    </script>
</x-layouts.client-layout>