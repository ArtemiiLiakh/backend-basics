const { WeatherService } = require("../../services/WeatherService");

module.exports = {
  WeatherServiceDI: new WeatherService(),
};