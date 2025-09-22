import { useState } from 'react'

const FAQ = () => {
  const [openIndex, setOpenIndex] = useState(null)

  const faqs = [
    {
      question: "How many lessons would I need to learn decent level of driving?",
      answer: "Every individual is different and so is his/her learning power, grasping ability and the confidence-building time. Thus, it is difficult to say how many exact numbers of lessons you would need to learn decent level of driving. The instructor would initially assess your ability to grasp driving basics and would then be able to give you an estimate of the time you would need to develop proper skills. In most cases, one individual needs about 10 sessions of behind the wheel training and a set number of classroom education lessons. But we as a driving school, do not limit ourselves by setting a fixed number of classes and are patient enough to let slow learners develop skills as per their own pace and speed. Individual adaptability, home practice, previous knowledge and confidence level play an important role in deciding the number of lessons required."
    },
    {
      question: "How can I get some of my queries answered regarding your driving school?",
      answer: "Every individual is different and so is his/her learning power, grasping ability and the confidence-building time. Thus, it is difficult to say how many exact numbers of lessons you would need to learn decent level of driving. The instructor would initially assess your ability to grasp driving basics and would then be able to give you an estimate of the time you would need to develop proper skills. In most cases, one individual needs about 10 sessions of behind the wheel training and a set number of classroom education lessons. But we as a driving school, do not limit ourselves by setting a fixed number of classes and are patient enough to let slow learners develop skills as per their own pace and speed. Individual adaptability, home practice, previous knowledge and confidence level play an important role in deciding the number of lessons required."
    },
    {
      question: "Do you offer free pick up from home facility?",
      answer: "Every individual is different and so is his/her learning power, grasping ability and the confidence-building time. Thus, it is difficult to say how many exact numbers of lessons you would need to learn decent level of driving. The instructor would initially assess your ability to grasp driving basics and would then be able to give you an estimate of the time you would need to develop proper skills. In most cases, one individual needs about 10 sessions of behind the wheel training and a set number of classroom education lessons. But we as a driving school, do not limit ourselves by setting a fixed number of classes and are patient enough to let slow learners develop skills as per their own pace and speed. Individual adaptability, home practice, previous knowledge and confidence level play an important role in deciding the number of lessons required."
    },
    {
      question: "When should I organize professional driving classes for my daughter or son?",
      answer: "Every individual is different and so is his/her learning power, grasping ability and the confidence-building time. Thus, it is difficult to say how many exact numbers of lessons you would need to learn decent level of driving. The instructor would initially assess your ability to grasp driving basics and would then be able to give you an estimate of the time you would need to develop proper skills. In most cases, one individual needs about 10 sessions of behind the wheel training and a set number of classroom education lessons. But we as a driving school, do not limit ourselves by setting a fixed number of classes and are patient enough to let slow learners develop skills as per their own pace and speed. Individual adaptability, home practice, previous knowledge and confidence level play an important role in deciding the number of lessons required."
    },
    {
      question: "What is the cheapest way of booking my driving lessons?",
      answer: "Every individual is different and so is his/her learning power, grasping ability and the confidence-building time. Thus, it is difficult to say how many exact numbers of lessons you would need to learn decent level of driving. The instructor would initially assess your ability to grasp driving basics and would then be able to give you an estimate of the time you would need to develop proper skills. In most cases, one individual needs about 10 sessions of behind the wheel training and a set number of classroom education lessons. But we as a driving school, do not limit ourselves by setting a fixed number of classes and are patient enough to let slow learners develop skills as per their own pace and speed. Individual adaptability, home practice, previous knowledge and confidence level play an important role in deciding the number of lessons required."
    }
  ]

  const toggleFAQ = (index) => {
    setOpenIndex(openIndex === index ? null : index)
  }

  return (
    <section id="faq" className="py-20 bg-gray-50">
      <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <h2 className="text-4xl font-bold text-gray-800 mb-4">FAQ'S</h2>
          <div className="w-16 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div className="bg-white rounded-lg shadow-lg overflow-hidden">
          {faqs.map((faq, index) => (
            <div key={index} className="border-b border-gray-200 last:border-b-0">
              <div 
                className="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors cursor-pointer"
                onClick={() => toggleFAQ(index)}
              >
                <p className={`font-medium flex-1 ${openIndex === index ? 'text-gray-800' : 'text-green-600'}`}>{faq.question}</p>
                <button className="text-gray-600 hover:text-green-600 transition-colors">
                  <svg 
                    className="w-6 h-6 transition-transform duration-200" 
                    fill="none" 
                    stroke="currentColor" 
                    viewBox="0 0 24 24"
                  >
                    {openIndex === index ? (
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 12h12" />
                    ) : (
                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    )}
                  </svg>
                </button>
              </div>
              <div className={`overflow-hidden transition-all duration-300 ease-in-out ${openIndex === index ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'}`}>
                <div className="px-6 pb-6">
                  <p className="text-gray-600 leading-relaxed">{faq.answer}</p>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

export default FAQ
