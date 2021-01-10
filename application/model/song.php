<?php

class Song extends Model
{
    /**
     * Get all songs from database
     */
    public function getAllSongs()
    {
        $this->query("SELECT id, artist, track, link FROM " . DB_NAME . ".song");
        $this->execute();

        return $this->resultSet();
    }

    /**
     * Add a song to database
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     * @return string
     */

    public function addSong($artist, $track, $link)
    {
        $this->query("INSERT INTO " . DB_NAME . ".song (artist, track, link) VALUES (:artist, :track, :link)");
        $this->bind(':artist', $artist);
        $this->bind(':track', $track);
        $this->bind(':link', $link);

        return $this->lastInsertId();
    }

    /**
     * Delete a song in the database
     * @param int $song_id Id of song
     */
    public function deleteSong($song_id)
    {
        $sql = "DELETE FROM " . DB_NAME . ".song WHERE id = :song_id";
        $this->query($sql);
        $this->bind(':song_id', $song_id);

        $this->execute();
    }

    /**
     * Get a song from database
     * @param int $song_id Id of song
     * @return mixed
     */
    public function getSong($song_id)
    {
        $this->query("SELECT id, artist, track, link FROM " . DB_NAME . ".song WHERE id = :song_id LIMIT 1");
        $this->bind(':song_id', $song_id);

        return $this->single();
    }

    /**
     * Update a song in database
     * @param string $artist Artist
     * @param string $track Track
     * @param string $link Link
     * @param int $song_id Id
     */
    public function updateSong($artist, $track, $link, $song_id)
    {
        $this->query("UPDATE " . DB_NAME . ".song SET artist = :artist, track = :track, link = :link WHERE id = :song_id");
        $this->bind(":artist", $artist);
        $this->bind(":track", $track);
        $this->bind(":link", $link);
        $this->bind(":song_id", $song_id);

        $this->execute();
    }

    public function getAmountOfSongs()
    {
        $this->query("SELECT COUNT(id) AS amount_of_songs FROM " . DB_NAME . ".song");
        return $this->single()->amount_of_songs;
    }
}
