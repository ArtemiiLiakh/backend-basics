const express = require('express');
const { schema } = require('./graphql/schema');
const { graphqlHTTP } = require('express-graphql');

const app = express();

app.use(express.json());

app.use('/graphql', graphqlHTTP({
  schema,
  graphiql: true,
}));

module.exports = app;