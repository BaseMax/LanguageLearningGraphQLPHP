# Language Learning App - GraphQL API PHP

This project is a Language Learning App that provides a GraphQL API for language courses, vocabulary exercises, and language proficiency assessments. The API is developed in PHP 8 and allows users to access a wide range of language learning resources.

## Prerequisites

Before running the Language Learning App, ensure you have the following installed:

- PHP 8
- Composer (Dependency Manager for PHP)
- MySQL or any compatible database server

## Installation

### Clone the repository:

```bash
git clone https://github.com/BaseMax/LanguageLearningGraphQLPHP.git
cd LanguageLearningGraphQLPHP
```

### Install dependencies:

```bash
composer install
```

### Configure the environment:

Copy the `.env.example` file to `.env` and set the required environment variables such as database credentials and Redis configuration.

### Database

Run database migrations to set up the required tables:

```bash
php migrate.php
```

Start the development server:

```bash
cd public/
php -S localhost:8000 index.php
```

## GraphQL Schema

The Language Learning App API provides the following queries and mutations:

### Queries

- `courses: [Course!]!`: Get a list of available language courses.
- `course(id: ID!): Course`: Get a specific language course by its ID.
- `exercises(courseId: ID!): [Exercise!]!`: Get vocabulary exercises for a specific language course.
- `exercise(id: ID!): Exercise`: Get a specific vocabulary exercise by its ID.
- `assessments: [Assessment!]!`: Get language proficiency assessments.
- `assessment(id: ID!): Assessment`: Get a specific language proficiency assessment by its ID.

### Mutations

- `enroll(courseId: ID!): Course`: Enroll in a language course.
- `submitExercise(exerciseId: ID!, answer: String!): Exercise`: Submit an answer for a vocabulary exercise.
- `submitAssessment(assessmentId: ID!, answers: [AssessmentAnswerInput!]!): AssessmentResult`: Submit answers for a language proficiency assessment.

## Authentication

To access certain mutations, such as enrolling in a course or submitting exercises and assessments, users need to authenticate their requests. Please include an authentication token in the request headers using the following format:

```makefile
Authorization: Bearer YOUR_AUTH_TOKEN
```

The API uses JWT (JSON Web Tokens) for authentication. To obtain an authentication token, you can use the login mutation, passing your username and password as input, and it will return a token that you can use for subsequent requests.

## Error Handling

The API handles errors using GraphQL's built-in error handling mechanisms. If an error occurs, the API will provide meaningful error messages with relevant details.

## Caching

To improve performance, the API utilizes Redis caching for certain queries and data. Cached data will be served when available, reducing the load on the database.

## Documentation

For more information on the API's schema, queries, and mutations, you can access the GraphQL documentation tool at `http://localhost:8000/graphql-playground` after starting the development server.

## Contribution

Contributions to the Language Learning App project are welcome. If you find any issues or have ideas for improvements, please feel free to create a pull request or submit an issue in the repository.

## License

This project is licensed under the GPL-3.0 License.

Enjoy building your Language Learning App with the GraphQL API in PHP 8!

Copyright 2023, Max Base, Ali Ahmadi
