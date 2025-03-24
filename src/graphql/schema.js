const { makeExecutableSchema } = require('@graphql-tools/schema');
const fs = require('fs');
const path = require("path");
const { BookServiceDI } = require('../di/BookServiceDI');

const bookQuery = {
  async getBook(_, args) {
    const data = await BookServiceDI.getById(args.id);
    
    return {
      _id: data._id,
      title: data.title,
      author: data.author,
      year: data.year,
      createdAt: data.createdAt,
    }
  },
  async getBooks() {
    const data = await BookServiceDI.getMany();
    return data.map(book => ({
      _id: book._id,
      title: book.title,
      author: book.author,
      year: book.year,
      createdAt: book.createdAt,
    }));
  }
}

const bookMutation = {
  async create (_, data) {
    const book = await BookServiceDI.create({
    title: data.title,
    author: data.author,
      year: data.year,
    });

    return {
      _id: book._id,
      title: book.title,
      author: book.author,
      year: book.year,
      createdAt: book.createdAt,
    }
  },

  update (_, data) {
    BookServiceDI.update(data.id, {
      title: data.title,
      author: data.author,
      year: data.year,
    });
    return true;
  },

  delete (_, data) {
    BookServiceDI.delete(data.id);

    return true;
  }
};

const resolvers = {
  Query: {
    book: () => ({}),
  },
  Mutation: {
    book: () => ({}),
  },
  BookQuery: bookQuery,
  BookMutation: bookMutation
}

const schemaPath = path.join(__dirname, 'schema.graphql');
const schemaString = fs.readFileSync(schemaPath, 'utf8');
const schema = makeExecutableSchema({
  typeDefs: schemaString,
  resolvers,
});

module.exports = {
  schema,
};