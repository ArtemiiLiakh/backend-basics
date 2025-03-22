const express = require('express');
const cors = require('cors');
const path = require('path');
const { WeatherServiceDI } = require('./di/services/WeatherServiceDI');

const app = express();
app.set('view engine', 'ejs');

app.use(cors({
  origin: '*',
}));

app.set('views', path.join(__dirname, 'views'));

app.use(express.json());

app.get('/', (req, res) => {
  res.render('index');
});

app.get('/weather', async (req, res) => {
  const weatherData = await WeatherServiceDI.getByLocation(req.query.lat, req.query.long);
  res.render('weather', {
    weatherData,
  });
});

app.get('/weather/:city', async (req, res) => {
  const weatherData = await WeatherServiceDI.getByCity(req.params.city);
  res.render('weather', {
    weatherData,
  });
});

module.exports = app;