# Book Rating Application

This is a book rating application that allows users to browse, search, and rate books. This project is a submission for Timedoor Academy Pro as Online Programming Teacher. This project is built using Laravel 10.1 and PHP 8.1. Additionaly supported with Bootstrap and Yajra DataTables.

> *Created by: Jem Angkasa Wijaya*

## Tables of Contents

- [Book Rating Application](#book-rating-application)
  - [Tables of Contents](#tables-of-contents)
  - [Prequisites](#prequisites)
  - [Installation](#installation)
    - [View the list of top 10 most famous authors](#view-the-list-of-top-10-most-famous-authors)
      - [GET /authors](#get-authors)
    - [Rate books on a scale of 1 to 10](#rate-books-on-a-scale-of-1-to-10)
      - [GET /ratings](#get-ratings)
      - [GET /book/authorId](#get-bookauthorid)
      - [POST /ratings](#post-ratings)
  - [Contact](#contact)

## Prequisites

* PHP 8.1 or higher
* Laravel 7 or higher
* Composer
* MySQL 8.0 or higher

## Installation

To install the book rating application, follow these steps:

1. Clone the repository:

   ```
   git clone https://github.com/JAW12/timedoor_backend_bookstore.git
   ```

   Navigate to the project directory:
2. ```
   cd timedoor_backend_bookstore
   ```
3. Install the dependencies:

   ```
   composer install
   ```
4. Create a .env file in the root directory of the project.
5. Set up the MySQL database

   * Create new MySQL database
   * Update the database configuration in .env file with your database credentials.
6. Run the following command to migrate the database:

   ```
   php artisan migrate
   ```
7. Seed the database with initial data:

   ```
   php artisan db:seed
   ```
8. Generate a new encryption key:
    ```
    php artisan key:generate
    ```
9. Install the Node.js dependencies:
   ```
   npm install
   ```
10. Compile the application's assets and start the development server:

    ```
    npm run dev
    ```
11. Start the application.

    ```
    php artisan serve
    ```
12. The server should now be running at [http://localhost:8000](http://localhost:8000).

## Features

* Browse a list of books (order by average rating from highest to lowest)
  * Search for books by book title and author name
  * Filter for list of books shown
* View the list of top 10 most famous authors (order by voter from highest to lowest)
* Rate books on a scale of 1 to 10
  * Show list of books based on the author chosen

## How to use

1. Visit the application in your web browser.
2. The first time this page is loaded, it will shows a datatable of list of books with the highest average rating

   * Search for the book based on the book title or author name.
   * Choose to filter how many books shown on the list shown input.
   * Browse through the books list based on the page.
3. Navigate through the navigation bar to books, authors and ratings page.
4. View the list of top 10 most famour author based on their voters.
5. View the book rating input page.

   * Choose an author from the dropdown
   * Choose a book from the dropdown shown based on the author chosen.
   * Choose the rating score for the book chosen
   * Click the "Submit" button and redirected to the book list page.

## Endpoint Specification

### Browse a list of books

#### GET /

This endpoint shows a list of the 10 highest-rated books, paginated using DataTables.

#### GET /books

This endpoint retrieves a list of all books in the database in JSON format, for use in the DataTables library.

**Request Parameter(s):**

* `search `: based on the book title or author name
* `list_shown` : show the number of books per page

**Response:**

```json
{
    "draw": 1,
    "recordsTotal": 10000,
    "recordsFiltered": 10000,
    "data": [
        {
            "id": 174,
            "title": "Corrupti nam minima natus.",
            "category_id": 160,
            "author_id": 100,
            "rating_count": 1,
            "average_rating": 10,
            "category": {
                "id": 160,
                "name": "aliquid",
                "created_at": "2023-09-22T10:18:57.000000Z",
                "updated_at": "2023-09-22T10:18:57.000000Z"
            },
            "author": {
                "id": 100,
                "name": "Kamron Schaefer",
                "created_at": "2023-09-22T10:18:56.000000Z",
                "updated_at": "2023-09-22T10:18:56.000000Z"
            },
            "ratings": [
                {
                    "id": 13107,
                    "book_id": 174,
                    "rating": 10,
                    "created_at": "2023-09-22T11:01:27.000000Z",
                    "updated_at": "2023-09-22T11:01:27.000000Z"
                }
            ]
        },
        ...
    ],
    "input": {
        "draw": "1",
        "columns": [
            {
                "data": null,
                "name": null,
                "searchable": "true",
                "orderable": "true",
                "search": {
                    "value": null,
                    "regex": "false"
                }
            },
            {
                "data": "title",
                "name": null,
                "searchable": "true",
                "orderable": "true",
                "search": {
                    "value": null,
                    "regex": "false"
                }
            },
            {
                "data": "category.name",
                "name": null,
                "searchable": "true",
                "orderable": "true",
                "search": {
                    "value": null,
                    "regex": "false"
                }
            },
            {
                "data": "author.name",
                "name": null,
                "searchable": "true",
                "orderable": "true",
                "search": {
                    "value": null,
                    "regex": "false"
                }
            },
            {
                "data": "average_rating",
                "name": null,
                "searchable": "true",
                "orderable": "true",
                "search": {
                    "value": null,
                    "regex": "false"
                }
            },
            {
                "data": "rating_count",
                "name": null,
                "searchable": "true",
                "orderable": "true",
                "search": {
                    "value": null,
                    "regex": "false"
                }
            }
        ],
        "order": [
            {
                "column": "4",
                "dir": "desc"
            }
        ],
        "start": "0",
        "length": "10",
        "search": null,
        "list_shown": "10",
        "_": "1695650847141"
    }
}
```

### View the list of top 10 most famous authors

#### GET /authors

This endpoint shows a list of the top 10 authors with the most votes.

### Rate books on a scale of 1 to 10

#### GET /ratings

This endpoint shows the input rating page. (Authors dropdown, Books dropdown, Rating dropdown from 1 to 10)

#### GET /book/authorId

This endpoint retrieves a list of books by author ID, in JSON format.

**Request Parameter(s):**

* `author_id` : author id retrieved from the authors dropdown

**Response:**

```json
{
    "books": [
        {
            "id": 49,
            "title": "Et at sunt consectetur tempore voluptas sunt voluptatum qui.",
            "author_id": 3,
            "category_id": 55,
            "created_at": "2023-09-22T10:19:01.000000Z",
            "updated_at": "2023-09-22T10:19:01.000000Z"
        },
	...
	]
}
```

#### POST /ratings

This endpoint submits a new rating for a book.

**Request Parameter(s):**

* `book_id` : book id retrieved from the books dropdown
* `rating` : rating score retrieved from the ratings dropdown

**Response:**

redirect to `GET /`  with session flash message `"success"` => ""`Your rating has been saved successfully!"`

## Contact

**Jem Angkasa Wijaya**

jem.angkasaw@gmail.com

+6281273567384

[Jem Angkasa Wijaya | Linked In](https://www.linkedin.com/in/jem-angkasa-wijaya/)
