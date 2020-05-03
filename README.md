Project Management System

1. Open project_management_system folder 
2. cp .env.example .env  or copy the .env.example and change its name to .env
3. Add your database connection to the .env file.
4. Add google credentials (created in Google API) and add to .env.
   
   GOOGLE_CLIENT_ID=

   GOOGLE_CLIENT_SECRET=
   
   GOOGLE_REDIRECT=${APP_URL}/login/google/callback
   
   
5. Add a mail service into .env.
6. composer install
7. php artisan key:generate
8. php artisan migrate --seed
9. Ready to go! Visit your set domain "{domain}/".
10. For a first time admin login the role_id will need to be set to "2" in the database inside the users table. After users can be assigned new roles within the site.

© U1653907 Ashley Booth 2020
