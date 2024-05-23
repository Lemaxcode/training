USE training;
CREATE TABLE User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
CREATE TABLE Session (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    date DATETIME NOT NULL
);
CREATE TABLE Exercise (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    execution TEXT
);
CREATE TABLE SessionExercise (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_session INT NOT NULL,
    id_exercice INT NOT NULL,
    nbSerie INT NOT NULL,
    nbRepetition INT NOT NULL,
    charge FLOAT NOT NULL,
    FOREIGN KEY (id_session) REFERENCES session (id),
    FOREIGN KEY (id_exercice) REFERENCES exercise(id)
);
INSERT INTO Exercise (name, description, execution) VALUES
('Bench Press', 'Exercise that targets the chest muscles. It is performed by pressing a weight upwards while lying on a bench.', 'Lie down on the bench, grip the barbell, and press it upwards until your arms are fully extended. Lower it back slowly.'),
('Squat', 'Compound exercise that targets the legs, particularly the quadriceps, hamstrings, and glutes.', 'Stand with feet shoulder-width apart, hold the barbell on your shoulders, and lower your body by bending your knees. Return to standing position.'),
('Deadlift', 'Exercise that targets the back, legs, and core. It involves lifting a weight from the ground to hip level.', 'Stand with feet hip-width apart, grip the barbell, and lift it by extending your hips and knees to a standing position. Lower it back down.'),
('Pull-Up', 'Upper body exercise that targets the back and biceps. It involves pulling your body up while hanging from a bar.', 'Grip the pull-up bar with palms facing away, pull your body up until your chin is above the bar, then lower back down.'),
('Shoulder Press', 'Exercise that targets the shoulders and triceps. It involves pressing a weight overhead while standing or sitting.', 'Grip the dumbbells or barbell at shoulder level, press them overhead until your arms are fully extended, then lower back to shoulder level.'),
('Bicep Curl', 'Isolated exercise that targets the biceps. It involves curling a weight upwards with the arm.', 'Stand with feet shoulder-width apart, hold a dumbbell in each hand, curl the weights towards your shoulders, then lower them back down.'),
('Tricep Dip', 'Upper body exercise that targets the triceps. It involves lowering and raising the body using the arms.', 'Place your hands on parallel bars, lower your body by bending your elbows, then press back up to the starting position.'),
('Leg Press', 'Exercise that targets the quadriceps, hamstrings, and glutes. It is performed using a leg press machine.', 'Sit on the leg press machine, place your feet on the platform, and press the platform away by extending your legs. Return to the starting position.'),
('Lateral Raise', 'Exercise that targets the shoulder muscles. It involves lifting weights to the side of the body.', 'Stand with feet shoulder-width apart, hold a dumbbell in each hand, lift the weights to the side until your arms are parallel to the floor, then lower them back down.'),
('Plank', 'Core exercise that involves maintaining a position similar to a push-up for a period of time.', 'Get into a push-up position, but with your weight on your forearms and toes. Keep your body in a straight line and hold the position.')
;

