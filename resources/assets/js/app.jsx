import moment from "moment";
import React, { useEffect, useState } from "react";
import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import Modal from "react-bootstrap/Modal";
import { createRoot } from "react-dom/client";
import "../css/main.css";

export default function App() {
  const chartId = document
    .querySelector('meta[name="chart_id"]')
    .getAttribute("content");

  const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

  const [chart, setChart] = useState();
  const [remarks, setRemarks] = useState([]);
  const [trainees, setTrainees] = useState([]);
  const [trainee, setTrainee] = useState();

  /**
   * Trainee modal state
   */
  const [showAddTrainee, setShowAddTrainee] = useState(false);

  /**
   * Remove trainee modal state
   */
  const [showRemoveTrainee, setShowRemoveTrainee] = useState(false);
  const [removingTrainee, setRemovingTrainee] = useState();

  const closeRemoveTraineeModal = () => {
    setRemovingTrainee(undefined);
    setShowRemoveTrainee(false);
  };

  /**
   * Learning outcome state handler
   */
  const handleClick = (_trainee, _learningOutcome) => {
    const update = async () => {
      const response = await fetch(
        `http://localhost:8000/api/charts/${chartId}/remarks`,
        {
          method: "PUT",
          headers: {
            "Content-type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
          },
          body: JSON.stringify({
            trainee_id: _trainee.id,
            learning_outcome_id: _learningOutcome.id,
          }),
        },
      );
      const data = await response.json();
      setRemarks(data);
    };

    update();
  };

  useEffect(() => {
    const fetchData = async () => {
      const response = await fetch(
        `http://localhost:8000/api/charts/${chartId}`,
      );
      const data = await response.json();

      setChart(data);
    };

    fetchData();
  }, []);

  useEffect(() => {
    const fetchData = async () => {
      const response = await fetch(
        `http://localhost:8000/api/charts/${chartId}/remarks`,
      );
      const data = await response.json();

      setRemarks(data);
    };

    fetchData();
  }, []);

  useEffect(() => {
    const fetchData = async () => {
      const response = await fetch("http://localhost:8000/api/trainees");
      const data = await response.json();
      setTrainees(data);
    };

    fetchData();
  }, []);

  return chart ? (
    <>
      <div className="text-center">
        <h4>{chart.qualification.title}</h4>
        <p className="text-muted">
          {moment(chart.start_date).format("MMMM DD, YYYY")} to{" "}
          {moment(chart.end_date).format("MMMM DD, YYYY")}
        </p>
      </div>

      <table>
        <thead>
          <tr>
            <th colSpan={4} className="text-align-bottom">
              Name of Trainee
            </th>
            {chart.qualification.competencies.map((competency) => (
              <React.Fragment key={crypto.randomUUID()}>
                <th rowSpan={2} className="table-header">
                  {competency.title}
                </th>
                {competency.learning_outcomes.map((learningOutcome) => (
                  <td rowSpan={2} key={crypto.randomUUID()} className="table-header">
                    {learningOutcome.description}
                  </td>
                ))}
              </React.Fragment>
            ))}
            <th rowSpan={2} className="text-align-bottom no-print">
              Action
            </th>
          </tr>
          <tr>
            <th className="text-align-bottom">Last name</th>
            <th className="text-align-bottom">First name</th>
            <th className="text-align-bottom">Middle initial</th>
            <th className="text-align-bottom">Trainee number</th>
          </tr>
        </thead>
        <tbody>
          {!(chart.trainees.length > 0) ? (
            <tr>
              <td colSpan="100%">No trainees in this monitoring chart.</td>
            </tr>
          ) : (
            <></>
          )}
          {chart.trainees.map((_trainee) => (
            <tr key={crypto.randomUUID()}>
              <td>{_trainee.last_name}</td>
              <td>{_trainee.first_name}</td>
              <td>{_trainee.middle_initial}</td>
              <td>{_trainee.trainee_number}</td>
              {chart.qualification.competencies.map((competency) => {
                const completed = competency.learning_outcomes.every(
                  (_learningOutcome) => {
                    return remarks.some((_remark) => {
                      return (
                        _remark.learning_outcome_id === _learningOutcome.id &&
                        _remark.completed &&
                        _remark.trainee_id == _trainee.id
                      );
                    });
                  },
                );

                return (
                  <React.Fragment key={crypto.randomUUID()}>
                    <td className="text-center">
                      <Form.Check
                        type="checkbox"
                        disabled
                        checked={completed}
                      />
                    </td>
                    {competency.learning_outcomes.map((_learningOutcome) => {
                      const remark = remarks.find((_remark) => {
                        return (
                          _remark.trainee_id == _trainee.id &&
                          _remark.learning_outcome_id == _learningOutcome.id
                        );
                      });

                      return (
                        <td key={crypto.randomUUID()} className="text-center">
                          <Form.Check
                            type="checkbox"
                            onChange={(e) => {
                              handleClick(_trainee, _learningOutcome);
                            }}
                            checked={remark ? remark.completed : false}
                          />
                        </td>
                      );
                    })}
                  </React.Fragment>
                );
              })}
              <td className="no-print">
                <button
                  style={{ all: "unset" }}
                  onClick={() => {
                    setRemovingTrainee(_trainee);
                    setShowRemoveTrainee(true);
                  }}
                >
                  <i className="fa fa-solid fa-trash text-danger"></i>
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      <div className="d-flex mt-3 justify-content-between align-items-center">
        <div>
          <p>Signed & Approved by:</p>
          <p className="mb-0 fw-bold">{chart.instructor.user.name}</p>
          <p>{chart.qualification.title} Trainer</p>
        </div>

        <div className="no-print">
          <Button
            variant="primary"
            size="sm"
            onClick={() => setShowAddTrainee(true)}
          >
            Add Trainee
          </Button>
        </div>
      </div>

      <Modal show={showAddTrainee} onHide={() => setShowAddTrainee(false)}>
        <Modal.Header closeButton>
          <Modal.Title>Add Trainee</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <form
            action={`http://localhost:8000/api/charts/${chartId}/trainees`}
            method="post"
            id="addTraineeForm"
          >
            <input type="hidden" name="_token" value={csrfToken} />

            <Form.Select
              name="trainee_id"
              defaultValue="default"
              value={trainee}
              onChange={(e) => setTrainee(e.target.value)}
              size="sm"
              className="mb-3"
            >
              <option value="default" disabled>
                Select Trainee
              </option>
              {trainees.length > 0 ? (
                trainees.map((trainee) => (
                  <option value={trainee.id} key={crypto.randomUUID()}>
                    {trainee.last_name}, {trainee.first_name}{" "}
                    {trainee.middle_initial}
                  </option>
                ))
              ) : (
                <></>
              )}
            </Form.Select>
          </form>
        </Modal.Body>
        <Modal.Footer>
          <Button
            variant="secondary"
            size="sm"
            onClick={() => setShowAddTrainee(false)}
          >
            Close
          </Button>
          <Button
            type="submit"
            form="addTraineeForm"
            variant="primary"
            size="sm"
          >
            Save
          </Button>
        </Modal.Footer>
      </Modal>

      <Modal show={showRemoveTrainee} onHide={closeRemoveTraineeModal}>
        <Modal.Header closeButton>
          <Modal.Title>Remove Trainee</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <form
            action={`http://localhost:8000/api/charts/${chartId}/trainees/${removingTrainee?.id}`}
            method="post"
            id="removeTraineeForm"
          >
            <input type="hidden" name="_token" value={csrfToken} />
            <input type="hidden" name="_method" value="DELETE" />
            Are you sure you want to remove{" "}
            <strong>
              {removingTrainee?.last_name}, {removingTrainee?.first_name}{" "}
              {removingTrainee?.middle_initial}
            </strong>
            ?
          </form>
        </Modal.Body>
        <Modal.Footer>
          <Button
            variant="secondary"
            size="sm"
            onClick={closeRemoveTraineeModal}
          >
            Close
          </Button>
          <Button
            type="submit"
            form="removeTraineeForm"
            variant="primary"
            size="sm"
          >
            Save
          </Button>
        </Modal.Footer>
      </Modal>
    </>
  ) : (
    <></>
  );
}

document.addEventListener("DOMContentLoaded", function () {
  const domNode = document.getElementById("chart");
  const root = createRoot(domNode);
  root.render(<App />);
});
