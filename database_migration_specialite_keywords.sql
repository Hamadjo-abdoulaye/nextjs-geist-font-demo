-- Create table for specialty keywords
CREATE TABLE specialite_keywords (
    id INT PRIMARY KEY AUTO_INCREMENT,
    specialite_id INT NOT NULL,
    keyword VARCHAR(100) NOT NULL,
    FOREIGN KEY (specialite_id) REFERENCES specialites(id)
);

-- Insert sample keywords for specialties
INSERT INTO specialite_keywords (specialite_id, keyword) VALUES
(1, 'coeur'),
(1, 'cardiaque'),
(1, 'arteres'),
(2, 'cerveau'),
(2, 'neurologie'),
(2, 'nerfs'),
(3, 'feminin'),
(3, 'gynecologie'),
(3, 'uterus'),
(4, 'radiologie'),
(4, 'imagerie'),
(4, 'rayons x'),
(5, 'estomac'),
(5, 'intestin'),
(5, 'gastro'),
(6, 'laboratoire'),
(6, 'analyses'),
(6, 'sang');
