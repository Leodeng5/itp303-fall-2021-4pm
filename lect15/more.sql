-- Add a new album named "Fight On" 
-- by artist "Spirit of Troy"
SELECT * FROM albums;

INSERT INTO albums (title, artist_id)
VALUES ('Fight On', 276);

-- Quickly check if a new record was added to albums table
SELECT * FROM albums
ORDER BY album_id DESC;

-- Look up artist_id for Spirit of Troy. This artist does not exist.
-- Need to add this artist into artist table
SELECT * FROM artists
WHERE name LIKE '%spirit%';

-- Add 'Spirit of Troy' to artist table
INSERT INTO artists (name)
VALUES ('Spirit of Troy');

-- Check that Spirit of troy has been added
SELECT * FROM artists;

-- Update track 'All My Love' composed by E. Schordy and L. Dimant
-- to be part of Fight On album and composed by Tommy Trojan
UPDATE tracks
SET composer = 'Tommy Trojan', album_id = 348
-- Instead of this
-- WHERE name = 'All My Love';
-- Use PRIMARY key
WHERE track_id = 3316;

SELECT * 
FROM tracks
WHERE name LIKE 'all my love';


-- Delete the album 'Fight On'
-- Can't delete 'Fight On' because this album is being referenced
-- in the Tracks table (All My Love has album id 348)
-- Two solutions to go around this
DELETE
FROM albums
WHERE album_id = 348;

-- 1) Delete the 'All My Love' track
DELETE FROM tracks
WHERE track_id = 3316;

-- 2) Nullify the album_id for 'All My Love' track so that it no longer 
-- references 'Fight On' album
UPDATE tracks
SET album_id = null
WHERE track_id = 3316;

-- Create a view that displays all albums and their artist names
-- only show album id, album title, and aritst name
CREATE OR REPLACE VIEW album_artists AS
SELECT albums.album_id, albums.title, artists.name
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id;
    
-- "Call" the view and you can query it as well, like a real table
-- Views are read only, cannot alter a view
SELECT * 
FROM album_artists
WHERE album_id > 11;

-- Count all of the tracks in the database
SELECT COUNT(*)
FROM tracks;

SELECT COUNT(*), COUNT(composer)
FROM tracks;

-- Average length of a song?
SELECT AVG(milliseconds), MAX(milliseconds), MIN(milliseconds)
FROM tracks;

SELECT * FROM tracks;

-- How long is album_id 1? 
SELECT SUM(milliseconds)
FROM tracks
WHERE album_id = 2;

SELECT AVG(milliseconds)
FROM tracks;

-- Find the average length of tracks in EACH album
SELECT album_id, AVG(milliseconds)
FROM tracks
GROUP BY album_id;

-- For each artist, show artists and number of their albums
SELECT artist_id, COUNT(*)
FROM albums
GROUP BY artist_id;

-- Same as above, but also see the actual artist name.
SELECT artists.artist_id, artists.name, COUNT(*)
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id
GROUP BY albums.artist_id;

