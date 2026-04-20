
				/// GEOMAN
				// Input для вывода координат
				const polyCoordsInput = document.getElementById('poly_coords');

				// Включаем инструменты Geoman
				map.pm.addControls({
					position: 'topleft',
					/*
					drawPolygon: true,
					editMode: true,
					removalMode: true,
					drawMarker: false,
					drawCircleMarker: false,
					drawPolyline: true,  // Включено для рисования линий
					drawCircle: false,
					drawRectangle: false
					*/
				});

					// Настройки Geoman
					map.pm.setGlobalOptions({
						allowSelfIntersection: false,
						snappable: true,
						snapDistance: 20
					});

					// === Функция получения координат полигона в L.CRS.Simple ===
					function getPolygonCoords(layer) {
						if (!(layer instanceof L.Polygon)) return '';
						
						// В L.CRS.Simple: lat = Y, lng = X
						const latlngs = layer.getLatLngs()[0];
						
						// Формируем массив [X, Y] где X=lng, Y=lat
						const coords = latlngs.map(ll => {
							const x = Math.round(ll.lng); // X координата
							const y = Math.round(ll.lat); // Y координата
							return `[${x},${y}]`;
						});
						
						return coords.join(',');
					}

					// === Функция получения координат полилинии в L.CRS.Simple ===
					function getPolylineCoords(layer) {
						if (!(layer instanceof L.Polyline)) return '';
						
						// В L.CRS.Simple: lat = Y, lng = X
						const latlngs = layer.getLatLngs();
						
						// Формируем массив [X, Y] где X=lng, Y=lat
						const coords = latlngs.map(ll => {
							const x = Math.round(ll.lng); // X координата
							const y = Math.round(ll.lat); // Y координата
							return `[${x},${y}]`;
						});
						
						return coords.join(',');
					}

					// === 1. Создание полигона, маркера ИЛИ полилинии ===
					map.on('pm:create', function(e) {
						if (e.layer instanceof L.Polygon) {
							const coords = getPolygonCoords(e.layer);
							polyCoordsInput.value = coords;
							console.log('✅ Полигон создан:', coords);
							e.layer.on('pm:edit', updateCoords);
							e.layer.on('pm:remove', clearCoords);
							e.layer._coords = coords;
						}
						// === Обработка создания маркера ===
						else if (e.layer instanceof L.Marker) {
							const coords = getMarkerCoords(e.layer);
							polyCoordsInput.value = coords;
							console.log('✅ Маркер создан:', coords);
							e.layer.on('pm:edit', updateMarkerCoords);
							e.layer.on('pm:remove', clearCoords);
							e.layer._coords = coords;
						}
						// === Обработка создания полилинии (линии) ===
						else if (e.layer instanceof L.Polyline) {
							const coords = getPolylineCoords(e.layer);
							polyCoordsInput.value = coords;
							console.log('✅ Линия создана:', coords);
							e.layer.on('pm:edit', updatePolylineCoords);
							e.layer.on('pm:remove', clearCoords);
							e.layer._coords = coords;
						}
					});

					// === 2. Редактирование полигона ===
					function updateCoords(e) {
						if (e.layer instanceof L.Polygon) {
							const coords = getPolygonCoords(e.layer);
							polyCoordsInput.value = coords;
							e.layer._coords = coords;
							console.log('✏️ Полигон отредактирован:', coords);
						}
					}

					// === Редактирование маркера ===
					function updateMarkerCoords(e) {
						if (e.layer instanceof L.Marker) {
							const coords = getMarkerCoords(e.layer);
							polyCoordsInput.value = coords;
							e.layer._coords = coords;
							console.log('✏️ Маркер перемещён:', coords);
						}
					}

					// === Редактирование полилинии (линии) ===
					function updatePolylineCoords(e) {
						if (e.layer instanceof L.Polyline) {
							const coords = getPolylineCoords(e.layer);
							polyCoordsInput.value = coords;
							e.layer._coords = coords;
							console.log('✏️ Линия отредактирована:', coords);
						}
					}

					// Подписываем маркеры и полилинии на событие редактирования
					map.on('pm:edit', function(e) {
						if (e.layer instanceof L.Marker) {
							updateMarkerCoords(e);
						} else if (e.layer instanceof L.Polygon) {
							updateCoords(e);
						} else if (e.layer instanceof L.Polyline) {
							updatePolylineCoords(e);
						}
					});

					map.on('pm:edit', updateCoords);

					// === 3. Удаление полигона, маркера ИЛИ полилинии ===
					function clearCoords(e) {
						if (e.layer instanceof L.Polygon || e.layer instanceof L.Marker || e.layer instanceof L.Polyline) {
							polyCoordsInput.value = '';
							console.log('🗑️ Объект удалён');
						}
					}

					map.on('pm:remove', clearCoords);

					// === 4. (Опционально) Копирование по клику ===
					polyCoordsInput.addEventListener('click', function() {
						if (this.value) {
							this.select();
							navigator.clipboard?.writeText(this.value);
							console.log('📋 Скопировано в буфер');
						}
					});

					// === 5. (Опционально) Импорт полигона из координат ===
					function loadPolygonFromCoords(coordsString) {
						// Ожидаем формат: "[x1,y1],[x2,y2],[x3,y3]"
						const regex = /\[(-?\d+),(-?\d+)\]/g;
						const latlngs = [];
						let match;
						
						while ((match = regex.exec(coordsString)) !== null) {
							const x = parseInt(match[1]);
							const y = parseInt(match[2]);
							// В L.CRS.Simple: [lat, lng] = [Y, X]
							latlngs.push([y, x]);
						}
						
						if (latlngs.length >= 3) {
							const polygon = L.polygon(latlngs, {
								color: '#2e7d32',
								weight: 3,
								fillOpacity: 0.2
							}).addTo(map);
							
							// Подписываем на события
							polygon.on('pm:edit', updateCoords);
							polygon.on('pm:remove', clearCoords);
							
							polyCoordsInput.value = coordsString;
							map.fitBounds(polygon.getBounds());
							
							console.log('📥 Полигон загружен:', coordsString);
							return polygon;
						} else {
							console.error('❌ Недостаточно точек для полигона');
							return null;
						}
					}

				//////// построение полигонов - ЭНД
				
				/////// Маркеры Старт
				
				// === Функция получения координат маркера в L.CRS.Simple ===
				function getMarkerCoords(layer) {
					if (!(layer instanceof L.Marker)) return '';
					const latlng = layer.getLatLng();
					const x = Math.round(latlng.lng); // X координата
					const y = Math.round(latlng.lat); // Y координата
					return `[${x},${y}]`;
				}