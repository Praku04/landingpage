<?php
require_once '../php/config.php';
require_login();

$user = get_current_user();

// Get user's bookings
$sql = "SELECT * FROM service_bookings WHERE user_id = ? ORDER BY booking_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user['id']);
$stmt->execute();
$bookings = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Services - TMG</title>
    <link rel="stylesheet" href="../css/style.css?v=3.0.5">
    <link rel="stylesheet" href="../css/dashboard.css?v=3.0.5">
    <link rel="stylesheet" href="../css/services-booking.css?v=3.0.5">
</head>
<body>
    <div class="services-booking-container">
        <div class="services-booking-content">
            <h1>Book a Service</h1>
            <p>Choose from our expert services</p>
            
            <!-- Services Grid -->
            <div class="booking-services-grid">
                <div class="booking-service-card">
                    <div class="service-icon">🎤</div>
                    <h3>Mock Interview</h3>
                    <p>Practice with industry experts</p>
                    <button onclick="openBookingModal('mock_interview')" class="btn-book">Book Now</button>
                </div>
                
                <div class="booking-service-card">
                    <div class="service-icon">💼</div>
                    <h3>Career Counselling</h3>
                    <p>Get personalized guidance</p>
                    <button onclick="openBookingModal('career_counselling')" class="btn-book">Book Now</button>
                </div>
                
                <div class="booking-service-card">
                    <div class="service-icon">🎯</div>
                    <h3>Placement Support</h3>
                    <p>End-to-end assistance</p>
                    <button onclick="openBookingModal('placement_support')" class="btn-book">Book Now</button>
                </div>
            </div>
            
            <!-- My Bookings -->
            <div class="my-bookings">
                <h2>My Bookings</h2>
                <?php if ($bookings->num_rows > 0): ?>
                <div class="bookings-list">
                    <?php while ($booking = $bookings->fetch_assoc()): ?>
                    <div class="booking-item">
                        <div class="booking-info">
                            <h4><?php echo ucwords(str_replace('_', ' ', $booking['service_type'])); ?></h4>
                            <p>Booked on: <?php echo date('M d, Y', strtotime($booking['booking_date'])); ?></p>
                            <?php if ($booking['preferred_date']): ?>
                            <p>Preferred: <?php echo date('M d, Y', strtotime($booking['preferred_date'])); ?> at <?php echo date('h:i A', strtotime($booking['preferred_time'])); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="booking-status status-<?php echo $booking['status']; ?>">
                            <?php echo ucfirst($booking['status']); ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php else: ?>
                <p class="no-bookings">No bookings yet. Book a service to get started!</p>
                <?php endif; ?>
            </div>
            
            <a href="index.php" class="btn-back-dash">← Back to Dashboard</a>
        </div>
    </div>
    
    <!-- Booking Modal -->
    <div id="bookingModal" class="booking-modal">
        <div class="booking-modal-content">
            <span class="close-modal" onclick="closeBookingModal()">&times;</span>
            <h2 id="modalTitle">Book Service</h2>
            <form id="bookingForm">
                <input type="hidden" id="serviceType" name="service_type">
                
                <div class="form-group-booking">
                    <label>Preferred Date</label>
                    <input type="date" name="preferred_date" required min="<?php echo date('Y-m-d'); ?>">
                </div>
                
                <div class="form-group-booking">
                    <label>Preferred Time</label>
                    <input type="time" name="preferred_time" required>
                </div>
                
                <div class="form-group-booking">
                    <label>Additional Notes</label>
                    <textarea name="notes" rows="4" placeholder="Any specific requirements..."></textarea>
                </div>
                
                <div class="form-message"></div>
                
                <button type="submit" class="btn-submit-booking">Confirm Booking</button>
            </form>
        </div>
    </div>
    
    <script src="../js/service-booking.js?v=3.0.5"></script>
</body>
</html>
