import { Link } from 'react-router-dom'

const Pricing = () => {
  const pricingPlans = [
    {
      title: "TEENS BEHIND THE WHEEL",
      subtitle: "We Issue A Six Month Driver's License Upon Completion Of The Course.",
      description: "Teenagers Driving License For Experienced teens (Under 18)",
      price: "$350",
      features: [
        "7 sessions, 50min driving & observation",
        "DDC/Permit Slip Green Slip required", 
        "Road test on the last day of Training",
        "Free Pickup & Drop Off"
      ],
      note: "In order to get a license, You'll need to bring in a photocopy of your valid VA learner permit, original DDC1 card from high school"
    },
    {
      title: "PRIVATE 1 ON 1 DRIVING",
      subtitle: "We provide only individual training",
      price: "$575",
      features: [
        "Free Pickup & Drop Off",
        "Quality instructions",
        "Offering detailed explanation",
        "Fully Secured Dual Control Vehicle",
        "No Delay",
        "Friendly instructor",
        "DMV Approved",
        "Fully insured"
      ]
    },
    {
      title: "RE-EXAMINATION CLASS",
      subtitle: "For 3 Times Road Test Fails Get Certificate On Completion",
      description: "For All Ages Teens & Adults",
      price: "$350",
      features: [
        "7 Session of Driving",
        "Road Re-Examination",
        "Required by DMV",
        "Free Pickup & Drop Off",
        "We will issue you the Certificate upon completion",
        "Fully Secured Dual Control vehicle",
        "DMV Approved",
        "Fully insured"
      ]
    },
    {
      title: "ADULT WAIVER COURSE",
      subtitle: "Get Drivers Education Certificate Only For Experienced Drivers",
      description: "Get Driver's Ed Certificate",
      price: "$575",
      features: [
        "7 sessions, 50min driving & observation",
        "Valid Virginia permit",
        "Road test on the last day of Training",
        "Waiver will issue to successful drivers",
        "Fully insured",
        "DMV Approved",
        "Friendly instructor"
      ],
      note: "Note: Once You Complete And Pass, We Issue the Certificate"
    }
  ]

  return (
    <section id="pricing" className="py-16 sm:py-20 bg-gray-100">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-12 sm:mb-16">
          <h2 className="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Pricing</h2>
          <p className="text-lg sm:text-xl text-gray-600">The Easy Way To Learn</p>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
          {pricingPlans.map((plan, index) => (
            <div key={index} className="bg-transparent border-2 border-green-300 rounded-lg p-4 sm:p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
              {/* Icon */}
              <div className="text-center mb-3 sm:mb-4">
                <div className="w-8 h-8 sm:w-10 sm:h-10 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                  <span className="text-green-600 text-sm sm:text-lg">🚗</span>
                </div>
              </div>

              {/* Title */}
              <h3 className="text-base sm:text-lg font-bold text-gray-800 mb-2">{plan.title}</h3>
              {plan.subtitle && (
                <p className="text-xs sm:text-sm text-gray-600 mb-2">{plan.subtitle}</p>
              )}
              {plan.description && (
                <p className="text-xs sm:text-sm text-gray-600 mb-3 sm:mb-4">{plan.description}</p>
              )}

              {/* Price */}
              <div className="mb-3 sm:mb-4">
                <span className="text-2xl sm:text-3xl font-bold text-green-600">{plan.price}</span>
              </div>

              {/* Features */}
              <ul className="space-y-1 sm:space-y-2 mb-3 sm:mb-4">
                {plan.features.map((feature, featureIndex) => (
                  <li key={featureIndex} className="flex items-start space-x-2">
                    <span className="bg-green-500 text-white text-xs rounded-full w-3 h-3 sm:w-4 sm:h-4 flex items-center justify-center flex-shrink-0 mt-0.5">✓</span>
                    <span className="text-gray-700 text-xs sm:text-sm">{feature}</span>
                  </li>
                ))}
              </ul>

              {/* Note */}
              {plan.note && (
                <p className="text-xs text-gray-500 mb-3 sm:mb-4 italic">{plan.note}</p>
              )}

              {/* Button */}
              <Link 
                to="/registration-form" 
                className="bg-white text-green-600 border-2 border-green-600 py-2 sm:py-3 px-4 sm:px-6 rounded-md text-xs sm:text-sm font-medium hover:bg-green-600 hover:text-white transition-colors inline-block w-full text-center"
              >
                Register Now
              </Link>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

export default Pricing
