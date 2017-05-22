API List
=====================================

Github link :: https://github.com/yatinmistry/student-exam-result-management

Database : student_management.sql find root directory

User Register
http://localhost/student_exam_reult_management/frontend/web/index.php?r=users/register&username=&password=&name=&email=&code=


User Login 
http://localhost/student_exam_reult_management/frontend/web/index.php?r=users/login&username=&password=

User Logout
http://localhost/student_exam_reult_management/frontend/web/index.php?r=users/logout&user_token=

Student List
http://localhost/student_exam_reult_management/frontend/web/index.php?r=student/list&user_token=

Student Add
http://localhost/student_exam_reult_management/frontend/web/index.php?r=student/add&user_token=&name=&age=&maths_marks=&science_marks=&english_marks=

Student Edit
http://localhost/student_exam_reult_management/frontend/web/index.php?r=student/edit&user_token=&id=&name=&age=&maths_marks=&science_marks=&english_marks=

Student Summary
http://localhost/student_exam_reult_management/frontend/web/index.php?r=student/summary&user_token=

Session Check
http://localhost/student_exam_reult_management/frontend/web/index.php?r=users/session



Yii 2 Advanced Project Template
===============================

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
