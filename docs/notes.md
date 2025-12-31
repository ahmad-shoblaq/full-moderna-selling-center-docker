# Notes

## Biggest Docker issue + solution
The PHP app originally connected to MySQL using `localhost`. In Docker, the PHP container must connect to the MySQL container using the service name (`db`). I fixed this by updating `src/db.php` to read DB_HOST/DB_NAME/DB_USER/DB_PASS from environment variables.

## Biggest Git/GitHub lesson
Small, meaningful commits and clear commit messages make it easy to track progress and verify work. Pushing to GitHub early also helps avoid losing work and makes the repo ready for submission.
