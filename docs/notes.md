# Notes

## Challenges Faced + Their Solutions
- **Assignment 2:**
   - The PHP app originally connected to MySQL using `localhost`. In Docker, the PHP container must connect to the MySQL container using the service name (`db`). I fixed this by updating `src/db.php` to read DB_HOST/DB_NAME/DB_USER/DB_PASS from environment variables.

- **Assignment 3:** 
   - The instructions in the video with free website didn't work so I used a paid service (Digital Ocean)

   - The application failed to connect to the database due to incorrect credentials and leftover Docker volumes. I fixed this by taking down the app, editing the db configuration and docker containers and then reuploading it clean.

## Biggest Git/GitHub lesson
Small, meaningful commits and clear commit messages make it easy to track progress and verify work. Pushing to GitHub early also helps avoid losing work and makes the repo ready for submission.
