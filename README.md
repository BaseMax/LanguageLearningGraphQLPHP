# Language Learning App - GraphQL API PHP

This project is a Language Learning App that provides a GraphQL API for language courses, vocabulary exercises, and language proficiency assessments. The API is developed in PHP 8 and allows users to access a wide range of language learning resources.

## Prerequisites

Before running the Language Learning App, ensure you have the following installed:

- PHP 8 or higher
- Composer (Dependency Manager for PHP)
- MySQL or any compatible database server
- Redis (for caching)

## Installation

Clone the repository:

```bash
git clone https://github.com/your-username/language-learning-app.git
cd language-learning-app
```

Install dependencies:

```bash
composer install
```

Configure the environment:
Copy the `.env.example` file to `.env` and set the required environment variables such as database credentials and Redis configuration.

Run database migrations to set up the required tables:

```bash
php artisan migrate
```

Start the development server:

```bash
php -S localhost:8000 -t public
```

## GraphQL Schema

The Language Learning App API provides the following queries and mutations:

### Queries
courses: [Course!]!: Get a list of available language courses.
course(id: ID!): Course: Get a specific language course by its ID.
exercises(courseId: ID!): [Exercise!]!: Get vocabulary exercises for a specific language course.
exercise(id: ID!): Exercise: Get a specific vocabulary exercise by its ID.
assessments: [Assessment!]!: Get language proficiency assessments.
assessment(id: ID!): Assessment: Get a specific language proficiency assessment by its ID.
Mutations
enroll(courseId: ID!): Enrollment: Enroll in a language course.
submitExercise(exerciseId: ID!, answer: String!): ExerciseResult: Submit an answer for a vocabulary exercise.
submitAssessment(assessmentId: ID!, answers: [AssessmentAnswerInput!]!): AssessmentResult: Submit answers for a language proficiency assessment.

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

## Testing

The API comes with a suite of unit tests and integration tests. To run the tests, execute the following command:

```bash
phpunit
```

## Documentation

For more information on the API's schema, queries, and mutations, you can access the GraphQL documentation tool at http://localhost:8000/graphql-playground after starting the development server.

## Contribution

Contributions to the Language Learning App project are welcome. If you find any issues or have ideas for improvements, please feel free to create a pull request or submit an issue in the repository.

## License

Copyright [Year], [Your Name]. This project is licensed under the MIT License.

Enjoy building your Language Learning App with the GraphQL API in PHP 8!

Copyright 2023, Max Base
