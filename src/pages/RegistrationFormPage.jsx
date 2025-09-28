import { useState } from 'react'

const RegistrationFormPage = () => {
  const [formData, setFormData] = useState({
    firstName: '',
    middleName: '',
    lastName: '',
    addressLine1: '',
    city: '',
    state: '',
    zipCode: '',
    age: '',
    schoolName: '',
    phone: '',
    email: '',
    course: '',
    comment: ''
  })

  const handleInputChange = (e) => {
    const { name, value } = e.target
    setFormData(prev => ({
      ...prev,
      [name]: value
    }))
  }

  const handleSubmit = async (e) => {
    e.preventDefault()
    
    try {
      // Submit the registration form directly
      const response = await fetch('/api/registration-simple.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
      })
      
      const result = await response.json()
      
      if (result.success) {
        alert('Registration submitted successfully! We will contact you soon.')
        // Reset form
        setFormData({
          firstName: '',
          middleName: '',
          lastName: '',
          addressLine1: '',
          city: '',
          state: '',
          zipCode: '',
          age: '',
          schoolName: '',
          phone: '',
          email: '',
          course: '',
          comment: ''
        })
      } else {
        alert('Error: ' + (result.error || 'Failed to submit registration'))
      }
    } catch (error) {
      console.error('Network error:', error)
      alert('Network error. Please try again.')
    }
  }

  return (
    <div className="min-h-screen pt-32" style={{ backgroundColor: '#666666BA' }}>
      <div className="max-w-4xl mx-auto px-4 py-16">
        <div className="bg-transparent rounded-lg p-8">
          <form onSubmit={handleSubmit} className="space-y-6">
            {/* Name Section */}
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label className="block text-white font-medium mb-2">
                  First Name <span className="text-red-500">*</span>
                </label>
                <input
                  type="text"
                  name="firstName"
                  value={formData.firstName}
                  onChange={handleInputChange}
                  placeholder="First Name"
                  className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white placeholder-gray-300"
                  required
                />
              </div>
              <div>
                <label className="block text-white font-medium mb-2">
                  Middle Name
                </label>
                <input
                  type="text"
                  name="middleName"
                  value={formData.middleName}
                  onChange={handleInputChange}
                  placeholder="Middle Name"
                  className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white placeholder-gray-300"
                />
              </div>
              <div>
                <label className="block text-white font-medium mb-2">
                  Last Name <span className="text-red-500">*</span>
                </label>
                <input
                  type="text"
                  name="lastName"
                  value={formData.lastName}
                  onChange={handleInputChange}
                  placeholder="Last Name"
                  className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white placeholder-gray-300"
                  required
                />
              </div>
            </div>

            {/* Address Section */}
            <div>
              <label className="block text-white font-medium mb-2">
                Address Line 1 <span className="text-red-500">*</span>
              </label>
              <input
                type="text"
                name="addressLine1"
                value={formData.addressLine1}
                onChange={handleInputChange}
                placeholder="Address Line 1"
                className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white placeholder-gray-300"
                required
              />
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label className="block text-white font-medium mb-2">
                  City <span className="text-red-500">*</span>
                </label>
                <input
                  type="text"
                  name="city"
                  value={formData.city}
                  onChange={handleInputChange}
                  placeholder="City"
                  className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white placeholder-gray-300"
                  required
                />
              </div>
              <div>
                <label className="block text-white font-medium mb-2">
                  State <span className="text-red-500">*</span>
                </label>
                <input
                  type="text"
                  name="state"
                  value={formData.state}
                  onChange={handleInputChange}
                  placeholder="State"
                  className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white placeholder-gray-300"
                  required
                />
              </div>
              <div>
                <label className="block text-white font-medium mb-2">
                  Zip Code <span className="text-red-500">*</span>
                </label>
                <input
                  type="text"
                  name="zipCode"
                  value={formData.zipCode}
                  onChange={handleInputChange}
                  placeholder="Zip"
                  className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white placeholder-gray-300"
                  required
                />
              </div>
            </div>

            {/* Age Section */}
            <div>
              <label className="block text-white font-medium mb-2">Age</label>
              <div className="flex flex-col space-y-2">
                <label className="flex items-center">
                  <input
                    type="radio"
                    name="age"
                    value="teen"
                    checked={formData.age === 'teen'}
                    onChange={handleInputChange}
                    className="mr-2"
                  />
                  <span className="text-white">Teen(Under 18)</span>
                </label>
                <label className="flex items-center">
                  <input
                    type="radio"
                    name="age"
                    value="adult"
                    checked={formData.age === 'adult'}
                    onChange={handleInputChange}
                    className="mr-2"
                  />
                  <span className="text-white">Adult(Above 18)</span>
                </label>
              </div>
            </div>

            {/* School Name */}
            <div>
              <label className="block text-white font-medium mb-2">School Name</label>
              <input
                type="text"
                name="schoolName"
                value={formData.schoolName}
                onChange={handleInputChange}
                placeholder="Closest Public High School"
                className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white placeholder-gray-300"
              />
            </div>

            {/* Contact Information */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block text-white font-medium mb-2">Phone</label>
                <input
                  type="tel"
                  name="phone"
                  value={formData.phone}
                  onChange={handleInputChange}
                  placeholder="Phone"
                  className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white placeholder-gray-300"
                />
              </div>
              <div>
                <label className="block text-white font-medium mb-2">
                  Email <span className="text-red-500">*</span>
                </label>
                <input
                  type="email"
                  name="email"
                  value={formData.email}
                  onChange={handleInputChange}
                  placeholder="Email Address"
                  className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white placeholder-gray-300"
                  required
                />
              </div>
            </div>

            {/* Course Registration */}
            <div>
              <label className="block text-white font-medium mb-2">What Course Are You Registering For?</label>
              <select
                name="course"
                value={formData.course}
                onChange={handleInputChange}
                className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-black placeholder-gray-300"
              >
                <option value="">- Select -</option>
                <option value="teen-behind-wheel">Teen Behind the Wheel</option>
                <option value="adult-behind-wheel">Adult Behind the Wheel</option>
                <option value="driver-education">Driver Education Class</option>
                <option value="re-examination">Re-Examination</option>
                <option value="private-lesson">Private Driving Lesson</option>
                <option value="5-point-class">5 Point Driving Improvement Class</option>
              </select>
            </div>

            {/* Comment Section */}
            <div>
              <label className="block text-white font-medium mb-2">Comment</label>
              <textarea
                name="comment"
                value={formData.comment}
                onChange={handleInputChange}
                rows={4}
                className="w-full px-4 py-3 bg-transparent border border-white rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-white placeholder-gray-300"
                placeholder="Any additional comments or questions..."
              />
            </div>

            {/* Submit Button */}
            <div className="text-center">
              <button
                type="submit"
                className="bg-green-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors"
              >
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  )
}

export default RegistrationFormPage
