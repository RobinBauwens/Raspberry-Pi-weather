USE WeatherStation;
DELETE FROM WeatherData WHERE ID + 200 <= (
		SELECT * FROM (
			SELECT MAX(WeatherData.ID) FROM WeatherData
				) AS X
		);


# Verwijder eerste records zodat er 200 records (van de laatste records) overblijven
# In MySQL kan je de tabel die je gebruikt in een subquery niet verwijderen in de outer query
# ") AS X" vlak na innerquery 

# https://stackoverflow.com/questions/17742214/you-cant-specify-target-table-name-for-update-in-from-clause
# https://stackoverflow.com/questions/45494/mysql-error-1093-cant-specify-target-table-for-update-in-from-clause/45498#45498


