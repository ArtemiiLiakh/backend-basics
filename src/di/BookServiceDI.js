const { BookService } = require("../service/BookService");

module.exports = {
  BookServiceDI: new BookService(),
}