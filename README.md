cheerup
========
[![Build Status](https://travis-ci.org/harijoe/cheerup.svg)](https://github.com/harijoe/cheerup)

## Installation

```
git clone git@github.com:harijoe/symfony-vagrant-up.git
cd cheerup/vagrant
vagrant up
cd ..
composer install
```


To provision (configure to prod first):
`ansible-playbook -i inventory site.yml`

To deploy :
`shipit prod deploy`

TODO :
  - Replace datepicker displays
  - Add test for reset password
  - Fix provisioning for prod (need ubuntu users as default nginx/php-fpm user)