const path = require('path');
const express = require('express');
const { BookModel } = require('./db/Books');

const app = express();

app.use(express.json());
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

app.get('/', async (req, res) => {
  const books = await BookModel.find();
  res.render('books', { books });
});

app.get('/book/:bookId', async (req, res) => {
  const book = await BookModel.findById(req.params.bookId);
  res.json(book);
});

app.post('/books', async (req, res) => {
  const { title, author, year } = req.body;
  await BookModel.create({ title, author, year });
  res.redirect('/');
});

app.post('/books/:id/update', async (req, res) => {
  const { title, author, year } = req.body;
  await BookModel.findByIdAndUpdate(req.params.id, { title, author, year });
  res.redirect('/');
});

app.post('/books/:id/delete', async (req, res) => {
  await BookModel.findByIdAndDelete(req.params.id);
  res.redirect('/');
});

module.exports = app;