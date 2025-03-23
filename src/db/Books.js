const { default: mongoose } = require("mongoose");

const booksSchema = new mongoose.Schema({
  title: String,
  author: String,
  year: Number,
  createdAt: { type: Date, default: Date.now },
});

const BookModel = mongoose.model('books', booksSchema);

module.exports = {
  BookModel,
};