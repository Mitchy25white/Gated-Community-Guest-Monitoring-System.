# 🎯 Feature Documentation

## Live Dashboard

### Real-Time Guest Updates
- Refreshes every 3 seconds automatically
- Shows current guests inside the estate
- Displays entry time, host unit, vehicle info
- Visual status indicators (Approved/Flagged/Pending)

### Security Analytics

**Auto-Flagging Rules:**
- Guests staying > 2 hours → `FLAGGED`
- Guests with no host verification → `PENDING`
- Multiple entries same day → `REVIEW`

### Statistics Dashboard

```
📊 Today's Guests       → Total count
👥 Currently Inside     → Active guests
⚠️ Flagged Guests      → Security alerts
⏱️ Avg Visit Time      → Duration analytics
```

## Guest Entry Flow

```
Visitor Arrival
    ↓
Guest fills entry form
    ↓
Validation (vehicle plate, host unit)
    ↓
Database insert (status: PENDING)
    ↓
Admin/Host receives notification
    ↓
Host approves/rejects
    ↓
Status updates on dashboard
```

## Security Features

### Anomaly Detection
- ✅ Extended visit flagging
- ✅ Duplicate entry warnings
- ✅ Vehicle plate history
- ✅ Host unit verification

### Access Control
- Role-based dashboard (Admin, Host, Guard)
- Entry/exit log maintenance
- Audit trail for all changes

## API Specification

### Get Current Guests
```bash
curl http://localhost:8000/api/guests
```

**Response:**
```json
{
  "success": true,
  "count": 5,
  "guests": [
    {
      "id": 1,
      "name": "John Doe",
      "entry_time": "2026-07-18 08:30:00",
      "host": "Apt 101",
      "vehicle": "ABC123",
      "status": "approved"
    }
  ]
}
```

### Register Guest
```bash
curl -X POST http://localhost:8000/api/guests \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Jane Smith",
    "host": "Apt 205",
    "vehicle": "XYZ789",
    "estate_id": 1
  }'
```

## Performance Optimization

### Database Indexes
```sql
-- Speed up guest lookups
CREATE INDEX idx_entry_time ON guests(entry_time DESC);
CREATE INDEX idx_estate_id ON guests(estate_id);
CREATE INDEX idx_status ON guests(status);
```

### Query Optimization
- Prepared statements prevent injection
- Limited queries with pagination
- Caching for frequently accessed data

## Scalability

### Current Capacity
- 1000+ guests/day per estate
- Sub-100ms response time
- Supports 5+ concurrent admin users

### Future Scaling
- Database replication for multiple estates
- Redis cache layer
- Microservices separation
- Load balancing for traffic spikes

## Deployment

### Development
```bash
php -S localhost:8000
```

### Production
```bash
# Use Apache/Nginx with PHP-FPM
# Enable SSL/TLS
# Setup environment variables
# Configure database backup
```

## Monitoring

- API response time metrics
- Guest entry/exit frequency
- Security alert statistics
- System uptime tracking
