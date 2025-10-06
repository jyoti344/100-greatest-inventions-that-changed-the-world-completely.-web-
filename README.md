# 100-greatest-inventions-that-changed-the-world-completely.-web-
a website for the world government that contains data about 100 greatest inventions that  changed the world completely. Their uses, name of the creator and country of origin mention these. add their demo videos respectively.

## pograms needed:
   1. [php](https://www.php.net/downloads.php")
   2. [Mysql](https://dev.mysql.com/downloads/installer/)
   3. [vscode](https://code.visualstudio.com/)

## Extentions to install
   1. live Server
   2. live Preview
   3. php Server
   4. rainbow CSV
   5. code runner

## Framework + librarys
   ps. if installed locally no need to call from the internet use localy installed one

   1. Bootstrap - "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
   2. Font Awesome - "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
   3. node js - "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"  (not used for backend that much)

## Necesary steps in sql before running
   imp. dont change the table and attribute nameings otherwise you have to modify every file
   1. create database 
   2. create two tables "users" , "inventions" 
        ### users table
          CREATE TABLE users (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            role ENUM('admin','user') DEFAULT 'user'
            );
        ### inventions table
          CREATE TABLE inventions (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            creator VARCHAR(255),
            country VARCHAR(100),
            description TEXT,
            video_url VARCHAR(255),
            category VARCHAR(100),
            year VARCHAR(50)
            );
     insert 1 low in "users" as admin manually (you can only acess admin signup inside admin dashbord , so without a admin id   you cant log_in into admin dashboard )

     example:
          INSERT INTO users (username, password, role)
          VALUES ('admin@example.com', MD5('admin123'), 'admin');
          (MD5 - hashed using MD5 here (you can use SHA2 or bcrypt for better security).)

### change "$pass","$db" inside config.php according to your db details
### Then RightClick inside index.php select "PHP server: Searve project"

### you-tube link:
   make sure when adding new invention video you use <u><b>embed</b></u> link  not normal link 
   otherwise it won't work beacuse you-tube gonna refuse the video acess request

   ### getting embed ink:
    go to the video you want -> share -> embed -> then it will show a <iframe> snippet, copy the link from the <iframe> src



          

