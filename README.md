
![Logo](https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/2560px-PHP-logo.svg.png)


# Tournament and Registered Participants Module CoreFury Gym

This project focuses on the development of a new platform designed for the efficient management of the university gym. The platform provides gym employees with the ability to access their employee accounts, facilitating their daily tasks. For those employees who are new to the system, the platform offers the option to create an account easily.

In addition to implementing the login system, a module dedicated to "Tournaments and Participants" has been created. This module manages the various tournaments offered by the gym, allowing employees not only to administer tournament information but also to register participants. It goes beyond registration, providing the capability to edit and delete data of the registered participants.

The development of this platform has been carried out using an SQL database (MySQL) to store information in a structured manner. The set of technologies used includes PHP for server-side logic, jQuery to enhance interactivity, and Bootstrap styles for a modern and responsive user interface.

This project not only simplifies the daily operations of gym staff but also enhances the overall user experience by providing easy and efficient access to the services offered by the university gym.

## Project status

This project is currently in active development. Each module that will comprise the application is being developed by various collaborators, and progress is ongoing on different fronts. The content of this repository reflects the specific contribution I have made so far.

While some components may be fully functional, it's important to note that other parts of the project are still in the development process and may undergo significant changes in future updates. Specifically, in my collaboration, the sections for "Account Settings" and "Help" are yet to be developed. These features are located in the dropdown menu accessible by clicking on the profile picture.

Your contributions and feedback are welcome as we work to improve and complete all aspects of the project.
## Tech Stack

**Client:** Jquery, JavaScript, Bootstrap

**Server:** PHP

**DataBase:** Mysql


## Dependencies

**External Libraries (CDN)**

This project utilizes the following external libraries through CDN. Make sure to include them in your development environment:

**Bootstrap (5.2.3)**

This project leverages Bootstrap styles to craft a dynamic, visually appealing, and responsive user interface.

html
Copy code 

**links**
```html
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
```
**scripts**
```html
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
```

**jQuery (3.6.4)**

In addition, jQuery was incorporated to enhance the dynamics of the page, providing a more interactive experience. Its implementation ranges from adding components to improving table functionality and implementing features such as search in input fields, among others.

html
Copy code

**script**
```html
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
```

**Boxicons**

While leveraging Bootstrap icons, we also utilized icons from Boxicons. Some icons that couldn't be found in Bootstrap Icons were sourced from this excellent website called Boxicons. This choice was not only due to the unavailability in Bootstrap but also because the icons from Boxicons were visually more appealing.

html 
Copy code

**script**
```html
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
```

### Composer Packages

This project uses Composer packages. Make sure to install them by running the following commands:

vlucas/phpdotenv (v5.6)

**bash Copy code:**
composer require vlucas/phpdotenv:^5.6
phpmailer/phpmailer (v6.9)

**bash Copy code:**
composer require phpmailer/phpmailer:^6.9