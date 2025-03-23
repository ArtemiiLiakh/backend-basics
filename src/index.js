const mongoose = require('mongoose');
const config = require('./config');
const app = require('./app');

(async () => {
  await mongoose.connect(config.MONGO_URL, {
    // autoCreate: true,
  });
  
  app.listen(8000, () => {
    console.log('Server is running on port 8000');
  });
})();

