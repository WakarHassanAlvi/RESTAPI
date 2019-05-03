## Build Setup

``` bash
# install dependencies
$ yarn install

# serve with hot reload at localhost:3000
$ npm run dev

# build for production and launch server
$ npm run build
$ npm run start

# generate static project
$ yarn run generate
```

For detailed explanation on how things work, checkout [Nuxt.js docs](https://nuxtjs.org).

## Custom Guide

### Install Node JS and NPM

Follow this [link](https://blog.teamtreehouse.com/install-node-js-npm-windows) to installation instructions.

### Setup
Go to the root folder of the project. To configure the server port and API base URL open the ```nuxt.config.js``` file.

``` bash
axios: {
  baseURL: 'http://127.0.0.1:8000/api'
},

server: {
  port: 3000,
},
```

Update values if you want to change them. ```baseUrl``` represents the laravel API URL and ```/api``` prefix.

### Start Server

To start the server run below commands one after the other in a command window at the project root folder.

You have setup and start API before these commands.

``` bash
# install dependencies
$ npm run install

# build for production and launch server
$ npm run build
$ npm run start
```
Server will start in port ```3000``` or your custom port.

## Program Guide

If you start with default settings open a browser tab and go to [http://127.0.0.1:3000/](http://127.0.0.1:3000/) url. It will open operators page.

In the top navigation bar you can see ```Add Operator```, ```Operators```, ```Brands```, ```Add Add Brand``` links.

### Add Operator

To add an operator go to ```Add Operator``` link and enter details. Then press ```Add``` button. ```Reset``` button will reset the form. After adding an operator it will redirect to ```operators``` page.

### Operators

Operators page has a table which can use to sort and filter data. UI has a good guide to filter data. You have to press ```enter``` after enter filter data.

To sort table you have to press on the headers of the table. Both ascending and descending are available.

You can select a row by clicking on it. Then in the top you will have two options to ```Add Brand``` and to ```Edit Operator```.

Add Brand will open a form with operator ID on it. Fill other details and press ```Add``` to create the brand.

Edit Operator will open a form with operator's details except ID. After editing details press ```update``` to update the operator.

### Brands

Brands page has a table which can use to sort and filter data. UI has a good guide to filter data. You have to press ```enter``` after enter filter data.

To sort table you have to press on the headers of the table. Both ascending and descending are available.

You can select a row by clicking on it. Then in the top you will have option to ```Edit Brand```.

Edit Brand will open a form with brand's details except ID and operator ID. After editing details press ```update``` to update the brand.

### Add Brand

You can add a brand without going to ```Operator``` table using this option. But you need to know the operator's id for this. Therefore this is not recommended in normal usage. Always use the other method to Add a Brand.