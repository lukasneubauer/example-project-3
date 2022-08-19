# METALLORE

The goal of this project is to provide dynamic environment for development together with tools to generate static version of the website for production and deployment.

## Development

Development can be done either by using local tools or by utilizing Docker.

### Local

For local development, the following tools are required:

- php (8.1+)
- composer (2.4+)
- nodejs (latest)
- npm (latest)

To install Composer packages, run:

```
composer install
```

To install NPM packages, run:

```
npm ci
```

To execute the PHP built-in web server, run:

```
bin/serve
```

then check the output of said script and look for the website url in it. The example output could be:

```
[Sat Jan 01 12:00:00 2022] PHP 8.1.0 Development Server (http://127.0.0.1:8080) started
```

so the url to look for here is http://127.0.0.1:8080. Copy it into address bar in your web browser.

#### Generating Static Version Of The Website

To generate static version of the website for production and deployment, run:

```
bin/generate_static_website
```

The resulting HTML together with assets consisting of CSS, JavaScript, etc. will be generated into the `out` directory.

To execute the PHP built-in web server to serve the generated static content, run:

```
bin/serve_static
```

then check the output of said script and look for the website url in it. The example output could be:

```
[Sat Jan 01 12:00:00 2022] PHP 8.1.0 Development Server (http://127.0.0.1:8081) started
```

so the url to look for here is http://127.0.0.1:8081. Copy it into address bar in your web browser.

#### Testing

Execute the following script to run tests for phpunit:

```
bin/phpunit
```

### Docker

If there is Docker installed on the workstation, it can be used to avoid installing all the necessary tools locally.

To configure the environment, run:

```
docker_bin/docker_configure
```

Answer: `1`, `Y` and `Y` to configure the environment for development.

Answer: `2`, `N` and `N` to configure the environment for production.

Answer: `3`, `Y` and `N` to configure the environment for testing.

After configuration, run:

```
docker_bin/docker_build
```

to build Docker containers and after the build is done, run:

```
docker_bin/docker_up
```

to start Docker containers and then, run:

```
docker_bin/docker_initialize
```

to initialize the environment.

The website is served on:

- ip: `127.0.0.1`
- port: `8080`

so visit the http://127.0.0.1:8080 in your web browser.

Finally, run:

```
docker_bin/docker_down
```

to stop Docker containers.

#### Generating Static Version Of The Website

To generate static version of the website for production and deployment, run:

```
docker_bin/generate_static_website
```

The resulting HTML together with assets consisting of CSS, JavaScript, etc. will be generated into the `out` directory.

To execute the PHP built-in web server to serve the generated static content, run:

```
bin/serve_static
```

then check the output of said script and look for the website url in it. The example output could be:

```
[Sat Jan 01 12:00:00 2022] PHP 8.1.0 Development Server (http://127.0.0.1:8081) started
```

so the url to look for here is http://127.0.0.1:8081. Copy it into address bar in your web browser.

**NOTE**: To be able to run this script it is required to have `php (8.1+)` installed locally.

#### Testing

To configure the environment for testing, answer `3`, `Y` and `N` when running:

```
docker_bin/docker_configure
```

Then run the series of following scripts:

```
docker_bin/docker_build
```

```
docker_bin/docker_up
```

```
docker_bin/docker_initialize
```

After that, execute the following script to run tests for phpunit:

```
docker_bin/phpunit
```

## Database

The database is located in the `database` directory. Its structure on the filesystem has to be exactly as follows:

```
- database
    - Band
        - <year_of_the_album_release>_Album
            - <song_number_on_the_album>_Song.md
            - <song_number_on_the_album>_Song.md
            - <song_number_on_the_album>_Song.md
            - ...
```

To explicitly demonstrate the requirements, the following is the same structure, but without any placeholders:

```
- database
    - Metallica
        - 1997_Reload
            - 01_Fuel.md
            - 02_The_Memory_Remains.md
            - 03_Devil's_Dance.md
            - ...
```
