cities.forEach(city => {
  var marker = L.marker([city.lat, city.lng]).addTo(map);
  marker.bindPopup(`<b>${city.name}</b><br>Cliquer pour voir la météo.`);

  // Gestion de clic sur le marqueur
  marker.on('click', function () {
      alert(`Requête météo pour ${city.name}`); // Vérification de clic

      fetch(`fetch_weather.php?city=${city.name}`)
          .then(response => response.json())
          .then(data => {
              console.log(data); // Vérifiez les données renvoyées

              if (data.success) {
                  const temperatureCelsius = (data.temperature - 273.15).toFixed(2);

                  marker.bindPopup(`
                      <b>${city.name}</b><br>
                      Température : ${temperatureCelsius} °C<br>
                      Humidité : ${data.humidity} %<br>
                      Vent : ${data.wind_speed} km/h
                  `).openPopup();
              } else {
                  marker.bindPopup(`<b>${city.name}</b><br>Erreur : ${data.error}`).openPopup();
              }
          })
          .catch(err => {
              console.error("Erreur :", err);
              marker.bindPopup(`<b>${city.name}</b><br>Erreur lors de la récupération des données.`).openPopup();
          });
  });
});
