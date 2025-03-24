const path = require('path');
const express = require('express');
const { BookModel } = require('./db/Books');
const { schema } = require('./graphql/schema');
const { graphqlHTTP } = require('express-graphql');

const app = express();

app.use(express.json());
app.set('views', path.join(__dirname, 'views'));

app.use('/graphql', graphqlHTTP({
  schema,
  graphiql: true,
}));

module.exports = app;