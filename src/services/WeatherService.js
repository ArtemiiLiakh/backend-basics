const config = require('./../config');

class WeatherService {
  async getByCity (city) {
    const url = new URL('https://api.openweathermap.org/data/2.5/weather');
    url.searchParams.set('q', city+', UA');
    url.searchParams.set('appid', config.API_KEY);
    url.searchParams.set('units', 'metric');
    url.searchParams.set('lang', 'ua');

    const res = await fetch(
      url.toString(),
      {
        'method': 'GET',
      },
    );

    const data = await res.json();

    return {
      city: data.name,
      weather: data.weather[0].main, 
      icon: data.weather[0].icon,
      temperature: data.main.temp,
      humidity: data.main.humidity,
      pressure: data.main.pressure,
    }
  }

  async getByLocation (lat, long) {
    const url = new URL('https://api.openweathermap.org/data/2.5/weather');
    url.searchParams.set('lat', lat);
    url.searchParams.set('lon', long);
    url.searchParams.set('appid', config.API_KEY);
    url.searchParams.set('units', 'metric');

    const res = await fetch(
      url.toString(),
      {
        'method': 'GET',
      },
    );

    const data = await res.json();

    return {
      city: data.name,
      weather: data.weather[0].main, 
      icon: data.weather[0].icon,
      temperature: data.main.temp,
      humidity: data.main.humidity,
      pressure: data.main.pressure,
    }
  }
}

module.exports = { WeatherService };