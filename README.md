<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Project developed in the course of api laravel by Udemy

Developed in laravel the project consists of developing an api in Laravel

### Application testing requirements

- Laravel 9
- Php 8
- Project Clone

### How to inicializate it

- In the terminal type ' git clone https://github.com/joohnyfranzen/My_Property-Laravel_Project '

### Database:

- Users - Foreign - ( ( 'user_id' on 'real_state ) ( 'user_id' on 'user_profile' ))
1. name
2. email
3. email_verified_at
4. password

- Real State - Foreign - ( ( 'real_state_id' on 'real_state_categories' ) )
1. user_id - foreign -
2. title
3. description
4. content
5. price
6. bathrooms
7. bedrooms
8. property_area
9. total_property_area
10. slug

- Categories - Foreign - ( ( 'category_id' on 'real_state_categories' ) )
1. name
2. description
3. slug

- Real State Photos
1. real_state_id - foreign -
2. photo
3. is_thumb

- User Profile
1. user_id - foreign -
2. about
3. social_networks
4. phone
5. mobile_phone

- Real State Categories
1. real_state_id - foreign -
2. category_id - foreign -

- Contries States Cities
- Countries - Foreign - ( ( 'country_id' on 'states' ) )
1. name
2. slug
3. initials

- States - Foreign - ( ( 'state_id' on 'cities' ) ( 'state_id' on 'adresses' ) )
1. country_id - foreign -
2. name
3. slug
4. initials

- Cities - Foreign - ( ( 'city_id' on 'adresses' ) )
1. state_id - foreign -
2. name
3. slug

- Addresses - ( ( 'adresses_id' on 'real_state_add_collumn_adress_id' ) )
1. state_id - foreign -
2. city_id - foreign -
3. adress
4. neighborhood
5. complement
6. zip_code

- Real State - Add Collumn Address Id
1. adresses_id - foreign -

### Routes:
```
- _/api/v1

1. User

- _ /users _
[GET] '/' - INDEX
[GET] '/:id' - SHOW
[POST] '/' - STORE
[PUT] '/:id' - UPDATE
[DELETE] '/:id' - DELETE

2. Auth

[POST] '/login' - LOGIN
[GET] '/logout' - LOGOUT
[GET] '/refresh - TOKEN REFRESH

3. Categories

- _ /categories _
[GET] '/' - INDEX
[GET] '/:id' - SHOW
[POST] '/' - STORE
[PUT] '/:id' - UPDATE
[DELETE] '/:id' - DELETE

4. Real States

_ /real-states _ 
[GET] '/' - INDEX
[GET] '/:id' - SHOW
[POST] '/' - STORE
[PUT] '/:id' - UPDATE
[DELETE] '/:id' - DELETE

5. Real State Photo

_ /photos/set-thumb _ 

[PUT] '/:photoId/:realStateId' - UPDATE
[DELETE] '/:id' - DELETE



```

### Form Insert Tables
```
- User
[POST] '/' - STORE
1. name
2. email
3. email_verified_at
4. password
Can be added with
5. about
6. social_networks
7. phone
8. mobile_phone

- Categories
[POST] '/' - STORE
1. name
2. description
3. slug

- Real States
[POST] '/' - STORE
1. user_id - foreign -
2. title
3. description
4. content
5. price
6. bathrooms
7. bedrooms
8. property_area
9. total_property_area
10. slug

Can be added with

11. categories[]

And with

12. photo[] as file
```



