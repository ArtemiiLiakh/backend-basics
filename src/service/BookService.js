const { BookModel } = require( "../db/Books");

class BookService {
  getById (id) {
    return BookModel.findById(id);
  }

  getMany () {
    return BookModel.find();
  }

  async create (data) {
    return await BookModel.create({ 
      title: data.title, 
      author: data.author, 
      year: data.year,
    });
  }

  async update (id, data) {
    await BookModel.findByIdAndUpdate(id, { 
      title: data.title, 
      author: data.author, 
      year: data.year,
    });
  }

  async delete (id) {
    await BookModel.findByIdAndDelete(id);
  }
}

module.exports = {
  BookService,
}